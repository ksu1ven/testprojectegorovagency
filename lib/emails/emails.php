<?php

namespace Harbinger_Marketing;

use \Harbinger_Marketing\PDF_Generator;

add_filter( 'ninja_forms_action_email_message', __NAMESPACE__ . '\alter_email_template', 10, 3 );
function alter_email_template( $message, $data, $action_settings ) {
	ob_start();

	$fields = \Harbinger_Marketing\get_ninja_form_email_fields( $data['fields_by_key'] );

	switch ( $data['settings']['key'] ) {
		case 'application-form':
			require( THEME_EMAIL_TEMPLATES_PATH . '/application-form.php' );
			break;

		default:
			require( THEME_EMAIL_TEMPLATES_PATH . '/default.php' );
			break;
	}

	return ob_get_clean();
}

add_filter( 'ninja_forms_action_email_attachments', __NAMESPACE__ . '\application_form_email_add_pdf_attachment', 10, 3 );
function application_form_email_add_pdf_attachment( $attachments, $data, $settings ) {
	if ( $data['settings']['key'] != 'application-form' ) {
		return $attachments;
	}

	$pdf_template = THEME_PDF_TEMPLATES_PATH . '/application-form.php';
	$pdf_data     = array(
		'form_title' => $data['settings']['title'],
		'fields'     => \Harbinger_Marketing\get_ninja_form_email_fields( $data['fields_by_key'] )
	);

	$pdf_file_name = 'application-' . hash( 'md5', $pdf_template . serialize( $pdf_data ) ) . '.pdf';
	$attachments[] = PDF_Generator::generate( $pdf_template, $pdf_data, $pdf_file_name );

	return $attachments;
}

function get_ninja_form_email_fields( $fields ) {
	foreach ( $fields as $key => &$field ) {
		if ( \Harbinger_Marketing\contains_excluded_field_type( $field['type'] ) ) {
			unset( $fields[ $key ] );

			continue;
		}

		if ( $field['type'] == 'repeater' ) {
			$repeater_id_key_mapping = array();

			foreach ( $field['fields'] as $bad_key => $sub_field ) {
				$field['fields'][ $sub_field['key'] ] = $sub_field;

				unset( $field['fields'][ $bad_key ] );

				$repeater_id_key_mapping[ $sub_field['id'] ] = $sub_field['key'];
			}

			foreach ( $field['value'] as $bad_key => $value_array ) {
				$new_key = str_replace(
					array_keys( $repeater_id_key_mapping ),
					array_values( $repeater_id_key_mapping ),
					$bad_key
				);

				if ( stripos( $bad_key, '_' ) === false ) {
					$new_key .= '_0';
				}

				$field['value'][ $new_key ] = $value_array['value'];

				unset( $field['value'][ $bad_key ] );
			}

			for ( $i = 0; $i < ( count( $field['value'] ) / count( $repeater_id_key_mapping ) ); $i++ ) {
				$values_are_empty = true;

				foreach ( $repeater_id_key_mapping as $mapping_key ) {
					if ( strlen( $field['value'][ $mapping_key . '_' . $i ] ) ) {
						$values_are_empty = false;

						break;
					}
				}

				if ( $values_are_empty ) {
					foreach ( $repeater_id_key_mapping as $mapping_key ) {
						unset( $field['value'][ $mapping_key . '_' . $i ] );
					}
				}
			}
		}
	}

	return array_values( $fields );
}

function contains_excluded_field_type( $field_type ) {
	$excluded_field_types = array(
		'html',
		'hr',
		'confirm',
		'spam',
		'recaptcha',
		'submit',
		'user-analytics-browser',
		'user-analytics-browser-version',
		'user-analytics-region',
		'user-analytics-utm-term',
		'user-analytics-utm-source',
		'user-analytics-utm-medium',
		'user-analytics-utm-content',
		'user-analytics-utm-campaign',
		'user-analytics-referer',
		'user-analytics-longitude',
		'user-analytics-os',
		'user-analytics-latitude',
		'user-analytics-country',
		'user-analytics-ip-address',
		'user-analytics-city',
		'nf_uf_unified_source'
	);

	return in_array( $field_type, $excluded_field_types );
}

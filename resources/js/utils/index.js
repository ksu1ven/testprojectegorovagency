/**
 * Cookie functions.
 *
 * @type {{set: cookie.set, get: (function(*): string|null)}}
 */
export const cookie = {
    get: cookieName => {
        let results = document.cookie.match( '(^|;) ?' + cookieName + '=([^;]*)(;|$)' )
        return results ? decodeURI( results[2] ) : null
    },
    set: ( name, value, days ) => {
        let expires = "";

        if ( days ) {
            const date = new Date();
            date.setTime( date.getTime() + days * 24 * 60 * 60 * 1000 );
            expires = "; expires=" + date.toUTCString();
        }

        document.cookie = name + "=" + (value || "") + expires + "; path=/; secure";
    }
}

/**
 * Debounce
 *
 * @param func
 * @param wait
 * @param immediate
 * @returns {(function(): void)|*}
 */
export const debounce = function( func, wait, immediate ) {
    let timeout;

    return function() {
        const context = this;
        const args = arguments;

        const later = function () {
            timeout = null

            if ( !immediate )
                func.apply( context, args );
        };

        const callNow = immediate && !timeout;

        clearTimeout( timeout );
        timeout = setTimeout(later, wait);

        if ( callNow )
            func.apply(context, args);
    };
}

export default {
    cookie,
    debounce
}
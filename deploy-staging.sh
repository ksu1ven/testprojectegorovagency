cd www/testproject.e2qr.com/wp-content/themes/testproject/

git fetch --all
git branch backup-branch
git checkout backup-branch
git add .
git commit -m "Backup of branch"
git checkout staging
git reset --hard origin/staging

composer install
nvm use 20.10.0
npm install
npm run build

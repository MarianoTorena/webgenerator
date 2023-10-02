cd ..
mkdir -p $1
chmod 757 $1
cd $1
mkdir -p css/user/ css/admin js/validations js/effects tpl php
echo $1 | cat > index.php
echo "" | cat > css/user/estilo.css
echo "" | cat > css/admin/estilo.css
echo "" | cat > js/validations/login.js
echo "" | cat > js/validations/register.js
echo "" | cat > js/effects/panels.js
echo "" | cat > tpl/main.tpl
echo "" | cat > tpl/login.tpl
echo "" | cat > tpl/profile.tpl
echo "" | cat > tpl/register.tpl
echo "" | cat > tpl/panel.tpl
echo "" | cat > tpl/crud.tpl
echo "" | cat > php/create.php
echo "" | cat > php/read.php
echo "" | cat > php/update.php
echo "" | cat > php/delete.php
echo "" | cat > php/dbconect.php
chmod 757 *
chmod 757 */*
chmod 757 */*/*
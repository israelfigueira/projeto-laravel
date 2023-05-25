
curl https://packages.microsoft.com/keys/microsoft.asc | apt-key add -

#Download appropriate package for the OS version
#Choose only ONE of the following, corresponding to your OS version

# Automatic version selection (does not work for 21.10, but 20.10 or 21.04 are fine)
curl https://packages.microsoft.com/config/ubuntu/$(lsb_release -r -s)/prod.list > /etc/apt/sources.list.d/mssql-release.list
curl https://packages.microsoft.com/config/ubuntu/20.04/prod.list | sudo tee /etc/apt/sources.list.d/msprod.list

# Manual specification: Ubuntu 21.04
curl https://packages.microsoft.com/config/ubuntu/21.04/prod.list > /etc/apt/sources.list.d/mssql-release.list


apt-get update
apt-get install -y libodbc1
ACCEPT_EULA=Y apt-get install -y msodbcsql17
# optional: for bcp and sqlcmd
# ACCEPT_EULA=Y apt-get install -y mssql-tools
# echo 'export PATH="$PATH:/opt/mssql-tools/bin"' >> ~/.bashrc
# source ~/.bashrc
# optional: for unixODBC development headers
apt-get install -y mssql-tools odbcinst1debian2 unixodbc-dev
apt install php-pear
pecl install sqlsrv pdo_sqlsrv
printf "; priority=20\nextension=sqlsrv.so\n" > /etc/php/8.2/mods-available/sqlsrv.ini
printf "; priority=30\nextension=pdo_sqlsrv.so\n" > /etc/php/8.2/mods-available/pdo_sqlsrv.ini
# exit
phpenmod -v 8.2 sqlsrv pdo_sqlsrv
php -v
php -i | grep sqlsrv

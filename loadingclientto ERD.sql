use banksystem

bulk insert banksystem.bank.client
from 'C:\xampp\htdocs\client.txt'
with 
(
rowterminator='\n',
fieldterminator=';'
)
use banksystem

bulk insert Dwbank.banksys.customer
from 'C:\Users\Faizan\Desktop\customer.csv'
with 
(
rowterminator='\n',
fieldterminator=','
)
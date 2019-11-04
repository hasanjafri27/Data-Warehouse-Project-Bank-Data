use banksystem
select bank.account.account_id, bank.account.date1 as openingDate, bank.card.type as card_type, 
bank.disposition.type as dispositionType, bank.card.issued
from bank.account,bank.disposition,bank.card
where bank.disposition.account_id=bank.account.account_id
and bank.disposition.disp_id= bank.card.card_id
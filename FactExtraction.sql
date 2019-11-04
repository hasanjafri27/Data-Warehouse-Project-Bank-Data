use banksystem

select bank.transaction1.account_id,bank.disposition.client_id,
bank.district.district_id, bank.transaction1.trans_id, sum(bank.transaction1.amount) as totalTransaction

from bank.transaction1,bank.district ,bank.account,bank.disposition
where 
 bank.transaction1.account_id = bank.account.account_id and
 bank.district.district_id = bank.account.district_id and
 bank.disposition.account_id = bank.account.account_id
 group by bank.transaction1.account_id,bank.disposition.client_id,bank.district.district_id,bank.transaction1.trans_id
 having count(*)>0
 order by bank.transaction1.account_id
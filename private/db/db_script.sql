CREATE DATABASE IF NOT EXISTS citifinancedb;
GRANT ALL PRIVILEGES ON citifinancedb.* TO 
'webphpuser'@'localhost' IDENTIFIED BY 'password';


USE citifinancedb;

CREATE TABLE persons(
	person_id INT(11) PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    birthdate DATE NOT NULL,
    nationality VARCHAR(255) NOT NULL,
    sex CHAR(1) NOT NULL,
    phone_number CHAR(13) NOT NULL,
    email VARCHAR(255) NOT NULL
);

CREATE TABLE address(
	address_id INT(11) PRIMARY KEY AUTO_INCREMENT,
    person_id INT(11) NOT NULL,
    country VARCHAR(255) NOT NULL,
    city VARCHAR(255) NOT NULL,
    npa INT(5) NOT NULL,
    street VARCHAR(255) NOT NULL,
    address_status VARCHAR(15) NOT NULL,
    
   CONSTRAINT address_persons_fk FOREIGN KEY (person_id) REFERENCES persons(person_id)
);

CREATE TABLE client_auths(
	client_auth_id INT(11) PRIMARY KEY AUTO_INCREMENT,
    person_id INT(11) NOT NULL UNIQUE,
    nip CHAR(9) NOT NULL UNIQUE,
    hashed_password VARCHAR(255) NOT NULL, 
    
	CONSTRAINT client_auths_persons_fk FOREIGN KEY (person_id) REFERENCES persons(person_id)
);


CREATE TABLE ibans(
	iban_id INT(11) PRIMARY KEY AUTO_INCREMENT,
    iban_number CHAR(26) NOT NULL UNIQUE
);

CREATE TABLE account_types(
	account_type_id INT(11) PRIMARY KEY AUTO_INCREMENT,
    type_name VARCHAR(255) NOT NULL UNIQUE
);

INSERT INTO account_types(type_name) VALUES('Checking account');
INSERT INTO account_types(type_name) VALUES('Saving account');
INSERT INTO account_types(type_name) VALUES('Certificate of deposit');
INSERT INTO account_types(type_name) VALUES('Retirement account');

CREATE TABLE accounts(
	account_id INT(11) PRIMARY KEY AUTO_INCREMENT,
    account_type_id INT(11) NOT NULL,
    iban_id INT(11) NOT NULL,
    account_number CHAR(10) NOT NULL UNIQUE,
    overdraft DECIMAL(9,2) NOT NULL, /* overdraft never exceed 1 000 000.00 */
    interest_rate DECIMAL(7,6)  NOT NULL/* interest rate never exceed 0. 000 001 */,
    balance DECIMAL(15, 2) NOT NULL/* the balance never exceed 1 000 000 000 000.00 */,
    owner_type VARCHAR(15) NOT NULL,
    
    CONSTRAINT accounts_account_types_fk FOREIGN KEY (account_type_id) REFERENCES account_types(account_type_id),
    CONSTRAINT accounts_ibans_fk FOREIGN KEY (iban_id) REFERENCES ibans(iban_id)
);

CREATE TABLE individuals(
	individual_id INT(11) PRIMARY KEY AUTO_INCREMENT,
    person_id INT(11) NOT NULL UNIQUE,
    iban_id INT(11) NOT NULL UNIQUE,
    
    CONSTRAINT individuals_persons_fk FOREIGN KEY (person_id) REFERENCES persons(person_id),
    CONSTRAINT individuals_ibans_fk FOREIGN KEY (iban_id) REFERENCES ibans(iban_id)
);

CREATE TABLE enterprises(
	enterprise_id INT(11) PRIMARY KEY AUTO_INCREMENT,
    iban_id INT(11) NOT NULL UNIQUE,
    full_name VARCHAR(255) NOT NULL UNIQUE,
	creation_date DATE NOT NULL,
	country VARCHAR(30) NOT NULL,
    city VARCHAR(30) NOT NULL,
    npa INT(5) NOT NULL,
    street VARCHAR(255) NOT NULL,
    
    CONSTRAINT enterprises_ibans_fk FOREIGN KEY (iban_id) REFERENCES ibans(iban_id)
);

CREATE TABLE enterprise_admins(
	enterprise_admin_id INT(11) PRIMARY KEY AUTO_INCREMENT,
    person_id INT(11) NOT NULL UNIQUE,
    enterprise_id INT(11) NOT NULL,
    
    CONSTRAINT enterprise_admins_persons_fk FOREIGN KEY (person_id) REFERENCES persons(person_id),
    CONSTRAINT enterprise_admins_enterprises_fk FOREIGN KEY (enterprise_id) REFERENCES enterprises(enterprise_id)
);

CREATE TABLE card_types(
	card_type_id INT(11) PRIMARY KEY AUTO_INCREMENT,
    type_name VARCHAR(255) NOT NULL UNIQUE
);

CREATE TABLE bank_cards(
	bank_card_id INT(11) PRIMARY KEY AUTO_INCREMENT,
    card_type_id INT(11) NOT NULL,
	iban_id INT(11) NOT NULL,
    bin CHAR(19) NOT NULL UNIQUE,
	balance DECIMAL(15, 2) NOT NULL/* the balance never exceed 1 000 000 000 000.00 */,
    creation_date DATE NOT NULL,
    expired_date DATE NOT NULL,
    
    CONSTRAINT bank_cards_card_types_fk FOREIGN KEY (card_type_id) REFERENCES card_types(card_type_id),
    CONSTRAINT bank_cards_ibans_fk FOREIGN KEY (iban_id) REFERENCES ibans(iban_id)
);

CREATE TABLE transfert_debit_accounts(
	transfert_debit_id INT(11) PRIMARY KEY AUTO_INCREMENT,
	account_number VARCHAR(255) NOT NULL, /* always check that this account_number is either from account table or external_account table */
    account_type VARCHAR(15) /* externe or interne */
);

CREATE TABLE transfert_credit_accounts(
	transfert_credit_id INT(11) PRIMARY KEY AUTO_INCREMENT,
	account_number VARCHAR(255) NOT NULL, /* always check that this account_number is either from account table or external_account table */
	account_type VARCHAR(15) /* externe or interne */
    
);

CREATE TABLE transfert_debit_credits(
	transfert_debit_credit_id INT(11) PRIMARY KEY AUTO_INCREMENT,
	debit_account_id INT(11) NOT NULL,
    credit_account_id INT(11) NOT NULL,
	amount DECIMAL(11, 2) NOT NULL/* the amount never exceed 100 000 000.00 */,
    issued_date DATE NOT NULL,
    
    CONSTRAINT transfert_debit_credits_transfert_debit_accounts_fk FOREIGN KEY (debit_account_id) REFERENCES transfert_debit_accounts(transfert_debit_id),
	CONSTRAINT transfert_debit_credits_transfert_credit_accounts_fk FOREIGN KEY (credit_account_id) REFERENCES transfert_credit_accounts(transfert_credit_id)
);

CREATE TABLE payment_debit_accounts(
	payment_debit_id INT(11) PRIMARY KEY AUTO_INCREMENT,
	account_number VARCHAR(255) NOT NULL, /* always check that this account_number is either from account table or external_account table */
    account_type VARCHAR(15) /* externe or interne */
);

CREATE TABLE payment_credit_accounts(
	payment_credit_id INT(11) PRIMARY KEY AUTO_INCREMENT,
	account_number VARCHAR(255) NOT NULL, /* always check that this account_number is either from account table or external_account table */
    account_type VARCHAR(15) /* externe or interne */
    
);

CREATE TABLE payment_debit_credits(
	payment_debit_credit_id INT(11) PRIMARY KEY AUTO_INCREMENT,
	debit_account_id INT(11), /* NULL when bank_card_id is not null */
    bank_card_id INT(11), /* NULL when debit_account_id is not null */
    credit_account_id INT(11) NOT NULL,
    reference_number VARCHAR(255) NOT NULL,
	amount DECIMAL(15, 2) NOT NULL/* the amount never exceed 1 000 000 000 000.00 */,
    issued_date DATE NOT NULL,
    
    CONSTRAINT payment_debit_credits_payment_debit_accounts_fk FOREIGN KEY (debit_account_id) REFERENCES payment_debit_accounts(payment_debit_id),
    CONSTRAINT payment_debit_credits_bank_cards_fk FOREIGN KEY (bank_card_id) REFERENCES bank_cards(bank_card_id),
	CONSTRAINT payment_debit_credits_payment_credit_accounts_fk FOREIGN KEY (credit_account_id) REFERENCES payment_credit_accounts(payment_credit_id)
);

CREATE TABLE banks(
	bank_id INT(11) PRIMARY KEY AUTO_INCREMENT,
    full_name VARCHAR(255) NOT NULL UNIQUE,
	country VARCHAR(30) NOT NULL,
    city VARCHAR(30) NOT NULL,
    npa INT(5) NOT NULL,
    street VARCHAR(255) NOT NULL
);

CREATE TABLE external_accounts(
	external_account_id INT(11) PRIMARY KEY AUTO_INCREMENT,
    bank_id INT(11) NOT NULL,
	account_number VARCHAR(255) NOT NULL UNIQUE,
    iban_number CHAR(20) NOT NULL UNIQUE,
    
    CONSTRAINT external_accounts_banks_fk FOREIGN KEY (bank_id) REFERENCES banks(bank_id)
);
Use citifinancedb;
drop table transactions;
CREATE TABLE transactions(
    transaction_id INT(11) PRIMARY KEY AUTO_INCREMENT,
    account_id INT(11) , /* NULL when bank_card_id is not null */
    bank_card_id INT(11), /* NULL when account_id is not null */
    amount DECIMAL(15, 2),
    issued_date DATE NOT NULL,
    description VARCHAR(255),
    transaction_type VARCHAR(20), /* PAYMENT, TRANSFER-DEBIT, TRANSFER-CREDIT,  ADD MONEY ACCOUNT or ADD MONEY CARD */    
    
	CONSTRAINT transactions_accounts_fk FOREIGN KEY (account_id) REFERENCES accounts(account_id),
    CONSTRAINT transactions_bank_cards_fk FOREIGN KEY (bank_card_id) REFERENCES bank_cards(bank_card_id)
);
CREATE TABLE supply_accounts(
    supply_account_id INT(11) PRIMARY KEY AUTO_INCREMENT,
    account_id INT(11) NOT NULL,
    person_id INT(11) NOT NULL, /* determine who has add money in case of entreprise account */
    amount DECIMAL(15, 2),
    issued_date DATE NOT NULL, 
    
	CONSTRAINT supply_accounts_accounts_fk FOREIGN KEY (account_id) REFERENCES accounts(account_id),
	CONSTRAINT supply_accounts_persons_fk FOREIGN KEY (person_id) REFERENCES persons(person_id)
);



CREATE TABLE accounts (
    account_number  VARCHAR(36) PRIMARY KEY,
    balance         DECIMAL(15, 2) DEFAULT 0.00,
    name            VARCHAR(100) NOT NULL,
    description     TEXT,
    status          ENUM('active', 'inactive', 'suspended') DEFAULT 'active',
    created_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE user_accounts (
    user_id         INT UNSIGNED,
    account_number  VARCHAR(36),
    
    PRIMARY KEY (user_id, account_number),
    
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (account_number) REFERENCES accounts(account_number) ON DELETE CASCADE
);
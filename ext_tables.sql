#
# Table structure for table 'tx_koningapiqueue_domain_model_api'
#
CREATE TABLE tx_koningapiqueue_domain_model_api (
    uid int(11) NOT NULL auto_increment,
    pid int(11) DEFAULT '0',
    tstamp int(11) DEFAULT '0' NOT NULL,
    crdate int(11) DEFAULT '0' NOT NULL,
    cruser_id int(11) DEFAULT '0' NOT NULL,
    editlock tinyint(4) DEFAULT '0' NOT NULL,

    identifier varchar(225) DEFAULT '',
    name varchar(225) DEFAULT '',
    description text NOT NULL,
    location varchar(225) DEFAULT '',
    requests int(11) DEFAULT '0' NOT NULL,

    PRIMARY KEY (uid)
);

#
# Table structure for table 'tx_koningapiqueue_domain_model_request'
#
CREATE TABLE tx_koningapiqueue_domain_model_request (
    uid int(11) NOT NULL auto_increment,
    pid int(11) DEFAULT '0',
    tstamp int(11) DEFAULT '0' NOT NULL,
    crdate int(11) DEFAULT '0' NOT NULL,
    cruser_id int(11) DEFAULT '0' NOT NULL,
    editlock tinyint(4) DEFAULT '0' NOT NULL,

    api int(11) DEFAULT '0' NOT NULL,
    request int(11) DEFAULT '0' NOT NULL,
    location varchar(225) DEFAULT '',
    method varchar(6) DEFAULT '',
    body text NOT NULL,
    headers text NOT NULL,
    last_process_date int(11) DEFAULT '0' NOT NULL,
    responses int(11) DEFAULT '0' NOT NULL,

    PRIMARY KEY (uid)
);

#
# Table structure for table 'tx_koningapiqueue_domain_model_request'
#
CREATE TABLE tx_koningapiqueue_domain_model_response (
    uid int(11) NOT NULL auto_increment,
    pid int(11) DEFAULT '0',
    tstamp int(11) DEFAULT '0' NOT NULL,
    crdate int(11) DEFAULT '0' NOT NULL,
    cruser_id int(11) DEFAULT '0' NOT NULL,
    editlock tinyint(4) DEFAULT '0' NOT NULL,

    request int(11) DEFAULT '0' NOT NULL,
    processed_date int(11) DEFAULT '0' NOT NULL,
    status_code int(11) DEFAULT '0' NOT NULL,
    body text NOT NULL,

    PRIMARY KEY (uid)
);
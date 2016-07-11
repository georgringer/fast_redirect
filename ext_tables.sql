
CREATE TABLE tx_fast_redirect_entry (
  uid int(11) NOT NULL auto_increment,
  pid int(11) DEFAULT '0' NOT NULL,

  url_from varchar(255) DEFAULT '' NOT NULL,
  url_to varchar(255) DEFAULT '' NOT NULL,
  status_code int(3) unsigned DEFAULT '301' NOT NULL,

  PRIMARY KEY (uid),
  KEY parent (pid)
);
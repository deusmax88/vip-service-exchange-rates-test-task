-- auto-generated definition
create table exchangeRate
(
    dateTime     datetime      not null,
    currencyCode varchar(3)    not null,
    rate         decimal(6, 4) not null,
    primary key (dateTime, currencyCode)
);

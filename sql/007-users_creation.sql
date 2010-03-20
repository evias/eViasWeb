create table evias_users (
    user_id         serial      primary key,
    access_name     text        not null,
    access_pass     text        not null,
    realname        text,
    last_login      timestamp,
    date_creation   timestamp   not null default now(),
    date_updated    timestamp 
);


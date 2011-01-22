begin ;

create table evias_twitter_auth (
    user_id serial primary key,
    access_token text not null,
    access_token_secret text not null,
    consumer_secret text not null
) ;

# web.evias.be
insert into evias_twitter_auth
    select
        1,
        '72599124-3auc1nnLXf0kRf6an6JQc9tRG7Knoqnj6kv31WH7A',
        'tTyD7rBIKNmyOkZdB5zOQ121hLbfJwXhzOba4rr0E',
        'm9HsgRzBjwKID94scpJuJqtkWBSGeJIglEefKlVzpI'
    ;

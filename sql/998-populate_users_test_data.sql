begin;

insert into evias_users 
    (access_name, access_pass, realname)
values
    (
        'greg',
        'eViasdev',
        'Greg'
    );

insert into evias_users 
    (access_name, access_pass, realname)
values
    (
        'guest',
        '',
        'Visiteur'
    );

end;

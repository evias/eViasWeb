create table evias_blog (
    blog_id         serial      primary key,
    libelle         text        not null,
    description     text        not null,
    date_creation   timestamp   not null,
    date_updated    timestamp
);

create table evias_blog_category (
    category_id     serial      primary key,
    libelle         text        not null,
    description     text        not null,
	blog_id			integer		not null,
    date_creation   timestamp   not null,
    date_updated    timestamp
);

create table evias_blog_article (
    article_id      serial      primary key,
    titre           text        not null,
    contenu         text        not null,
    status_type_id  integer     not null,
	category_id 	integer		not null,
    date_creation   timestamp   not null,
    date_updated    timestamp   not null
);

create table evias_blog_article_status_type (
    status_type_id  serial      primary key,
    label           text        not null
);


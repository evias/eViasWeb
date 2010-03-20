---------
-- Create tables
---------
create table evias_catalogue (
    catalogue_id    serial      not null,
    title           text        not null,
    description     text        not null,
    date_creation   timestamp   not null default now(),
    date_updated    timestamp   not null default now()
);

create table evias_catalogue_category (
    category_id         serial      not null,
    parent_category_id  integer     default null,
    title               text        not null,
    description         text        not null,
	date_creation		timestamp	not null default now(),
	date_updated		timestamp	not null default now()
);

create table evias_catalogue_category_publishing_data (
    publishing_data_id  serial      not null,
    category_id         integer     not null,
    catalogue_id        integer     not null,
    access_level        integer     not null default 0,
    date_publish_begin  timestamp   not null default now(),
    date_publish_end    timestamp   default null,
    date_creation       timestamp   not null default now(),
    date_updated        timestamp   not null default now()
);

create table evias_catalogue_article (
    article_id          serial      not null,
    title               text        not null,
    description         text        not null,
    date_creation       timestamp   not null default now(),
    date_updated        timestamp   not null default now()
);

create table evias_catalogue_prize_data (
    prize_data_id       serial      not null,
    prize_amount_htva   float(2)    not null,
    currency_id         integer     not null,
	date_creation		timestamp	not null default now(),
	date_updated		timestamp	not null default now()
);

create table evias_catalogue_currency (
    currency_id         serial      not null,
    title               text        not null,
	date_creation		timestamp	not null default now(),
	date_updated		timestamp	not null default now()
);

create table evias_catalogue_article_publishing_data (
    publishing_data_id  serial      not null,
    article_id          integer     not null,
    category_id         integer     not null,
    catalogue_id        integer     not null,
    prize_data_id       integer     not null,
    acces_level         integer     not null default 0,
    date_publish_begin  timestamp   not null default now(),
    date_publish_end    timestamp   default null,
    date_creation       timestamp   not null default now(),
    date_updated        timestamp   not null default now()
);

-- type can be :
--  0 : image
--  1 : flash
--  2 : external url
create table evias_catalogue_article_resource (
    resource_id         serial      not null,
    article_id          integer     not null,
    type                integer     not null default 0,
    url                 text        not null,
	date_creation		timestamp	not null default now(),
	date_updated		timestamp	not null default now()
);

-- type can be :
--  0 : image
--  1 : flash
--  2 : external url
create table evias_catalogue_category_resource (
    resource_id         serial      not null,
    category_id         integer     not null,
    type                integer     not null default 0,
    url                 text        not null,
	date_creation		timestamp	not null default now(),
	date_updated		timestamp	not null default now()
);

-------------------------------------------------------
--				Add constraints						 --
-------------------------------------------------------

alter table evias_catalogue
	add constraint catalogue_id_index
	unique (catalogue_id);

alter table evias_catalogue_category
	add constraint category_id_index
	unique (category_id);

alter table evias_catalogue_article
	add constraint article_id_index
	unique (article_id);

alter table evias_catalogue_category_publishing_data
	add constraint category_publishing_data_id_index
	unique (publishing_data_id);

alter table evias_catalogue_article_publishing_data
	add constraint article_publishing_data_id_index
	unique (publishing_data_id);

alter table evias_catalogue_currency
	add constraint currency_id_index
	unique (currency_id);

alter table evias_catalogue_prize_data
	add constraint prize_data_id_index
	unique (prize_data_id);

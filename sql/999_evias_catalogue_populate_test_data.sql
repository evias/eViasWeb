truncate table evias_catalogue cascade;
truncate table evias_catalogue_category cascade;
truncate table evias_catalogue_article cascade;
truncate table evias_catalogue_currency cascade;
truncate table evias_catalogue_prize_data cascade;

-- add a catalogue
insert into evias_catalogue 
    (title, description)
values
    (
        'Online Catalogue',
        'Catalogue commun à tous les visiteurs.'
    );
    
-- add catalogue main categories

-- info & tech
insert into evias_catalogue_category
    (title, description)
values
    (
        'Informatique & Technologies',
        'Catégories des articles high-tech et ceux concernant l informatique.'
    );
    
-- livres
insert into evias_catalogue_category
    (title, description)
values
    (
        'Livres',
        'Catégories des livres, bande dessinées et romans.'
    );
    
-- video
insert into evias_catalogue_category
    (title, description)
values
    (
        'DVD & Cassette vidéo',
        'Catégories des articles vidéos.'
    );
    
-- musique
insert into evias_catalogue_category
    (title, description)
values
    (
        'Musique & Livres audio',
        'Catégorie regroupant les genres musicaux et livres audio.'
    );
    
-- add some sub categories

-- Informatique & Technologies => Accessoires audio
insert into evias_catalogue_category
    (parent_category_id, title, description)
values
    (
        (SELECT category_id
        FROM evias_catalogue_category
        WHERE title = 'Informatique & Technologies'
        LIMIT 1),
        'Accessoires audio',
        'Sous-catégorie regroupant les accessoires audio tels les enceintes, casques, etc.'
    );
    
-- Musique & Livres audio => Culture générale
insert into evias_catalogue_category
    (parent_category_id, title, description)
values
    (
        (SELECT category_id
        FROM evias_catalogue_category
        WHERE title = 'Musique & Livres audio'
        LIMIT 1),
        'Culture générale',
        'Sous-catégorie regroupant les livres audio concernant la culture générale.'
    );
    
    
-- add categories publishing data

-- info & tech [all]
insert into evias_catalogue_category_publishing_data
    (category_id, catalogue_id, access_level, date_publish_begin, date_publish_end)
values
    (
        (
			select 
				category_id
			from
				evias_catalogue_category
			where
				title = 'Informatique & Technologies'
			limit 1
		),
        (
			select
				catalogue_id
			from
				evias_catalogue
			where
				title = 'Online Catalogue'
			limit 1
		),
        0,
        now(),
        (now() + '2 days'::interval)
    );
    
-- info & tech [members]
insert into evias_catalogue_category_publishing_data
    (category_id, catalogue_id, access_level, date_publish_begin, date_publish_end)
values
    (
        (
			select 
				category_id
			from
				evias_catalogue_category
			where
				title = 'Informatique & Technologies'
			limit 1
		),
        (
			select
				catalogue_id
			from
				evias_catalogue
			where
				title = 'Online Catalogue'
			limit 1
		),
        1,
        now(),
        (now() + '1 year')
    );
    
-- livres [all]
insert into evias_catalogue_category_publishing_data
    (category_id, catalogue_id, access_level, date_publish_begin)
values
    (
        (
			select 
				category_id
			from
				evias_catalogue_category
			where
				title = 'Livres'
			limit 1
		),
        (
			select
				catalogue_id
			from
				evias_catalogue
			where
				title = 'Online Catalogue'
			limit 1
		),
        0,
        now()
    );
    
-- dvd & video [all]
insert into evias_catalogue_category_publishing_data
    (category_id, catalogue_id, access_level, date_publish_begin)
values
    (
        (
			select 
				category_id
			from
				evias_catalogue_category
			where
				title = 'DVD & Cassette vidéo'
			limit 1
		),
        (
			select
				catalogue_id
			from
				evias_catalogue
			where
				title = 'Online Catalogue'
			limit 1
		),
        0,
        now()
    );
    
-- musique & livres audio [all]
insert into evias_catalogue_category_publishing_data
    (category_id, catalogue_id, access_level, date_publish_begin)
values
    (
        (
			select 
				category_id
			from
				evias_catalogue_category
			where
				title = 'Musique & Livres audio'
			limit 1
		),
        (
			select
				catalogue_id
			from
				evias_catalogue
			where
				title = 'Online Catalogue'
			limit 1
		),
        0,
        now()
    );


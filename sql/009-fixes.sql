begin ;

alter table evias_blog_article add column small_contenu varchar (512) not null default '';

alter table evias_blog_article add column count_likes integer not null default 0;

insert into evias_blog_article_status_type select 1, 'Mise en attente';

insert into evias_blog_article_status_type select 2, 'Publication';

insert into evias_blog select '1', 'Blog de Greg', 'Grégory Saive, développeur de la plateforme eViasWeb', now(), now();

insert into evias_blog_category select 1, 'Divers', 'Articles traitant de choses non catégorisable', 1, now(), now();

insert into evias_blog_article_status_type select 3, 'Supprimé';


if (typeof(eVias) == 'undefined')
    var eVias = {};

eVias.Blog = {
    init : function ()
    {
        this._initMenu ();
    },

    _initMenu : function ()
    {

        $$('#blog-history ul li').each (function (elm) {
            var linkElm = elm.down ('a');

            var articleId = linkElm.readAttribute('rel');

            var showFullUrl = linkElm.readAttribute('href');

            var linkId = 'show-article-' + articleId;

            var linkDomElm = document.getElementById (linkId);

            linkDomElm.addEventListener('click', function (event) {
                new Ajax.Request (
                    showFullUrl,
                    {
                        asynchronous: false,
                        parameters : '',
                        onSuccess : function (transport) {
                            var articleContent = transport.responseText;
                            var articleTitle = document.getElementById (linkId).innerHTML;

                            $('article-title').update(articleTitle);
                            $('article-content').update (articleContent);

                            return false;
                        }
                    }
                );
            }, false);

        });
    }

};

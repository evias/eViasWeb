if (typeof(eVias) == 'undefined')
    var eVias = {};

/**
 * eVias.Blog class
 */
eVias.Blog = {
    _activeArticle : null,

    init : function ()
    {
        this._initMenu ();
        this._initActiveArticle();
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
    },

    /**
     * eVias.Blog.Article class
     */
    Article : {
        _title : '',
        _content : '',
        _codeSections : null,

        create : function (articleTitle, articleContent)
        {
            this._title =  articleTitle;
            this._content = articleContent;

            this._codeSections = new Array();

            this._initCodeSections();

            return this;
        },

        getTitle : function ()
        {
            return this._title;
        },

        getContent : function ()
        {
            return this._content;
        },

        /**
         * eVias.Blog.Article.Code class
         */
        Code : {
            _domElm : null,
            _toolbarHeight : 0,
            _toolbarWidth : 0,
            _divX : 0,
            _divY : 0,
            _divYAtInit : 0,
            _maxPointY : 0,
            _contentHtml : '',
            _toolbarElm : null,

            create : function (domElm, divX, divY, content) {
                this._domElm = domElm;
                this._divX = divX;
                this._divY = divY;
                this._contentHtml = content;
                this._toolbarWidth = 30;
                this._toolbarHeight = 150;

                this._divYAtInit = this._divY;

                var codeSectionDimensions = this._domElm.getDimensions();

                this._maxPointY = this._divYAtInit + parseInt(codeSectionDimensions.height) - this._toolbarHeight;

                this._initToolbar();

                return this;
            },

            _initToolbar : function ()
            {
                this._toolbarElm = new Element('div');

                // generate unique id
                var d = new Date();
                this._toolbarElm.setAttribute('id', 'code_toolbar_' + d.getTime());

                this._toolbarElm.setStyle ({
                    'position': 'absolute',
                    'left'  : this._divX + 'px',
                    'top'   : this._divY + 'px',
                    width   : this._toolbarWidth + 'px',
                    height  : this._toolbarHeight + 'px',
                    border  : '1px solid #000'
                });

                Element.insert (this._domElm, {'before': this._toolbarElm});

                document.addEventListener('DOMMouseScroll', function(evt) {
                    var event = evt || window.event;

                    var scrollType = (evt.detail ? (evt.detail*-120) : evt.wheelData) > 0 ? 'up' : 'down';

                    switch (scrollType) {

                        case 'up' :

                            if (this._divY == this._divYAtInit)
                                return ; // already at top

                            if (this._divY - 25 < this._divYAtInit)
                                this._divY = this.divYAtInit;
                            else
                                this._divY = this._divY - 25;

                            break;

                        case 'down':

                            if (this._divY == this._maxPointY)
                                return ; // already at bottom

                            if (this._divY + 25 > this._maxPointY)
                                this._divY = this._maxPointY;
                            else
                                this._divY = this._divY + 25;

                            break;

                        default : break;
                    }

                    this.verticalMoveToolbar(this._divY);

                }.bind(this), false);
            },

            verticalMoveToolbar : function (newY)
            {
                this._toolbarElm.setStyle ({
                    'top' : newY + 'px'
                });

                this._divY = newY;
            }
        },

        _initCodeSections : function ()
        {
            var codes = $$('div.code');
            var codesCount = codes.length;

            for (var i = 0; i < codesCount; i++) {
                var content = codes[i].innerHTML;

                // cloning the position creates an absolute positioned element
                // having the exact same position as the source element.
                // this helps me creating the toolbar right at the left of my code
                // container.
                // This "hack" will work on any Prototype supporting platform.
                var tmpElm = Element.clonePosition(new Element('div'), codes[i]);

                var divX = parseInt(tmpElm.style.left) - 45;
                var divY = parseInt(tmpElm.style.top);

                this._codeSections.push (eVias.Blog.Article.Code.create(codes[i], divX, divY, content));
            }
        }
    },

    _initActiveArticle : function ()
    {
        var articleTitle    = document.getElementById('article-title').innerHTML;
        var articleContent  = document.getElementById('article-content').innerHTML;

        this._activeArticle = eVias.Blog.Article.create (articleTitle, articleContent);
    }

};


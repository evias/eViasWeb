if (typeof(eVias) == 'undefined')
    var eVias = {};

if (typeof(eVias.Blog) == 'undefined')
    eVias.Blog = {};

eVias.Blog.Article = {
    /**
     * member variables
     */
    title   : '',
    content : '',
    codeSections : null,

    /**
     * public methods
     */
    create : function (articleTitle, articleContent)
    {
        this.title      = articleTitle;
        this.content    = articleContent;

        this._parseCodeSections();

        return this;
    },

    /**
     * private methods
     */
    _parseCodeSections : function ()
    {
        console.log('hello code sections');
    }
};

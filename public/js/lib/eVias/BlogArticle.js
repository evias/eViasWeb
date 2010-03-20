if (typeof eVias == 'undefined') 
    var eVias = {};

eVias.BlogArticle = {
    likeLink : null,
    dontLikeLink : null,
    commentLink : null,
    init : function() {
		this.initSmallDescLinks();
		this.initUserActions();
    },

	initSmallDescLinks : function() {
        $$('p.small-contenu').each ( function(element) {
            Element.observe(element, 'click', function(event) {
                var articleId = element.up('div').id;
                if (element.style.display !== 'none') {
                    // show full text
                    element.hide();
                    var imgHide = $(articleId + '-hide');
                    
                    Element.observe(imgHide, 'click', function(event) {
                        // HIDE image button event
                        imgHide.hide();
                        var elm = Element.siblings(imgHide.parentNode);
                        elm[3].hide();
                        elm[2].show();
                    });
                    imgHide.show();

                    $(articleId + '-full').show();
                }               
            });
        });
	},

	initUserActions : function() {
	    $$('p.user-actions').each (function(element) {
            var likeLink 		= element.down('a.like');
            var dontLikeLink 	= element.down('a.dontlike');
            var commentLink 	= element.down('a.comment');
            var articleId 		= element.up('div').id;
            var addForm 		= $(articleId + '-addcomment');
			var postCommentLink = addForm.childNodes[16];

			if (postCommentLink.className !== 'post-comment') {
				// loop to find it
				var i = 0;
				var found = false;
				while (i < addForm.childNodes.length) {
					found = (addForm.childNodes[i].className == 'post-comment');
					if (found) break;
					i++;
				}
	
				if (! found) {
					return ;
				}
			}
            
			Element.observe(commentLink, 'click', function(event) {
                if (addForm.style.display == 'none') {
                    addForm.show();
                }
                else {
                    addForm.hide();
                }
            });

			Element.observe(postCommentLink, 'click', function(event) {
				eVias.BlogArticle.handleCommentPost(articleId, addForm);
			});	
        });
	},

	handleCommentPost : function(articleId, formElm) {
		var validity = this.validateCommentData(formElm);
		
		if (validity) {
			var commentName = $('comment-name-'+articleId);
			var commentMail = $('comment-mail-'+articleId);
			var commentText = $('comment-text-'+articleId);
			console.debug(commentText);	
			var paramsName = commentName.value;
			var paramsMail = commentMail.value;
			var paramsText = commentText.value;
			var commentParams  = this.escapeMyComment(paramsName+'@_@'+paramsMail+'@_@'+paramsText); 			var urlParamsArray = commentParams.split('@_@');
			var urlParams = 'id='+articleId +'&name='+urlParamsArray[0]+'&mail='+urlParamsArray[1]+'&text='+urlParamsArray[2];
			console.log(urlParams);
			var ajaxRequest = new Ajax.Request(
				'blog/comment/add/'+articleId,
				{
					parameters : commentParams,
					asynchronous : true,
					method : 'get',
					onSuccess : function (xhrObj) {
					}
				}
			);		
		}
		
		return true;
	},

	validateCommentData : function(formElm) {
		return true;
	},

	escapeMyComment : function(escapeString) {		
		return escape(escapeString);
	}	
};

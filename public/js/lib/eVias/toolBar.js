if (eVias == 'undefined')
    var eVias = {};

eVias.toolBar = {
    _actions : null,
    init : function () {
        this._actions = new Array;
        eVias.toolBar.initSelectorActions('toolbar-select');
    },

    initSelectorActions : function(classPrefix) {
        var elms = Element.getElementsByClassName(classPrefix);

        var cntElms = elms.length;
        for(var i = 0; i < cntElms; ++i) {
            elms[i].onchange = "windows.location.href = '' + this.options[this.selectedIndex].value + ''";
        }
    }
};

document.addEventListener('onDOMReady', function(event) {
    eVias.toolBar.init();
}, false);

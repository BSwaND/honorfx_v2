var smetrics = {

    uslog: !1,

    readTextFile: function(file, callback) {
        var rawFile = new XMLHttpRequest();
        rawFile.overrideMimeType("application/json");
        rawFile.open("GET", file, true);
        rawFile.onreadystatechange = function() {
            if (rawFile.readyState === 4) {
                if(rawFile.status == "200") {
                    callback(rawFile.responseText);
                }
                else{
                    callback('~993');
                }
            }
        }
        rawFile.send(null);
    },

    showlog: function(obj, prevtext, useConsoleLog)
    {
        if(useConsoleLog){
            if(prevtext)
                console.log(prevtext);
            console.log(obj);
        }
    },

    sendRequest: function(metric, callback)
    {
        var json_upload = "metrics-data=" + JSON.stringify(metric);
        json_upload = json_upload.replace(/&/g, '%26');

        // console.log('send metrics-data:');
        // console.log(json_upload);

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("POST", '/smetrics/metrics.php');
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xmlhttp.send(json_upload);

        // dev test
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState === 4) {
                if(xmlhttp.status == "200"){

                    smetrics.showlog(xmlhttp.responseText, 'xmlhttp.responseText:', smetrics.uslog);

                    try {
                        var tmp = JSON.parse(xmlhttp.responseText);
                    } catch (err) {
                        // console.log('err json');
                        callback(xmlhttp.responseText);
                        return;
                    }

                    if(tmp.status == 'done'){
                        callback(tmp.data);
                    }
                    else if(tmp.status == 'failed'){
                        callback('~995');
                    }
                    else{
                        callback('~996');
                    }
                }
                else{
                    callback('~997');
                }
            }
        }
        // END dev test
    },

    getSelectors: function(config)
    {
        var cur_url = window.location.pathname.replace(/(.*)(index.php|index.html).*$/, "$1");
        cur_url = cur_url.replace(/(.*)(\?|#).*$/, "$1");
        cur_url = cur_url.replace(/[\/]{2,}/g,"/");
        var metrics = [];

        // console.log(data);

        for(var item in config) {

            var metrics_here = false;

            if(cur_url == item || item == '*'){
                metrics_here = true;
            }
            else if((n = item.indexOf('*')) != -1){
                item_n = item.substr(0, n-1);
                cur_url_n = cur_url.substr(0, n-1);
                if(item_n == cur_url_n){
                    metrics_here = true;
                }
            }

            if(metrics_here){
                for(var metric in config[item]) {
                    metrics.push({selector: config[item][metric]['selector'], smcache: metric, isJs: config[item][metric]['isJs']});
                    // console.log(metrics);
                }
            }
        }

        return metrics;
    },

    dataCollection: function(e, callback)
    {
        function zeroTime (n) {
            return ('00' + n).slice(-2);
        }

        if(e.tagName != 'FORM'){
            if(e.target.tagName == 'FORM'){
                e = e.target;
            }
            else {
                console.log('~889');
                return false;
            }
        }

        this.showlog(e, 'etarget:', smetrics.uslog);

        // console.log(smcache);
        // console.log(metrics_cur_page);

        // tmp = JSON.stringify();

        var metric = {};
        var inputs = [];
        var inputs_hidden = [];
        var input_item = {};


        var scrin_width = window.screen.width * window.devicePixelRatio;
        var scrin_height = window.screen.height * window.devicePixelRatio;
        var avail_width = window.screen.availWidth * window.devicePixelRatio;
        var avail_height = window.screen.availHeight * window.devicePixelRatio;
        var host = window.location.host;
        var cur_url = window.location.pathname;
        var protocol = window.location.protocol;
        var href = window.location.href;
        var date = new Date();
        var datetimeClient = date.getFullYear() + '-' +
            zeroTime(date.getMonth() + 1) + '-' +
            zeroTime(date.getDate()) + ' ' +
            zeroTime(date.getHours()) + ':' +
            zeroTime(date.getMinutes()) + ':' +
            zeroTime(date.getSeconds());
        var timeZoneClient = -(date.getTimezoneOffset() / 60);


        metric.info = {
            scrin_width: scrin_width,
            scrin_height: scrin_height,
            avail_width: avail_width,
            avail_height: avail_height,
            host: host,
            cur_url: cur_url,
            protocol: protocol,
            href: href,
            datetimeClient: datetimeClient,
            timeZoneClient: timeZoneClient,
            cache: e.smcache
        };


        // console.log('send metric.info:');
        // console.log(metric.info);

        for(var j = 0; ; j++){
            input_item = {};
            if((input = e[j]) != undefined){
                if(input.type == 'submit') {
                    continue;
                }

                input_item.type = input.type;
                input_item.name = input.name;

                if(input.type == 'hidden' || input.style.display === 'none'){
                    input_item.value = input.value;
                    inputs_hidden.push(input_item);
                }
                else if(input.type == 'select-one' || input.type == 'select-multiple'){
                    input_item.selects = [];
                    for(var k = 0; ; k++) {
                        if(input.selectedOptions[k] == undefined){
                            break;
                        }
                        mselect = {
                            innerHTML: input.selectedOptions[k].innerHTML,
                            value: input.selectedOptions[k].value
                        };

                        input_item.selects.push(mselect);
                    }
                    inputs.push(input_item);
                }
                else if(input.type == 'text' || input.type == 'textarea'){
                    input_item.value = input.value;
                    inputs.push(input_item);
                }
                else{
                    input_item.value = input.value;
                    inputs.push(input_item);
                }
            }
            else{
                break;
            }

        }

        metric.inputs = inputs;
        metric.inputs_hidden = inputs_hidden;

        this.showlog(metric, 'send metrics:', smetrics.uslog);

        this.sendRequest(metric, function(answer){
            e.smAnswer = answer;
            if(answer.length < 250)
                smetrics.showlog(answer, 'answer:', smetrics.uslog);
            else
                smetrics.showlog('', 'answer: ready shown above...', smetrics.uslog);

            if(callback) {
                callback(e);
            }
        });
    }
};


smetrics.readTextFile("/smetrics/config.json", function(jsConfig){

    (function(funcName, baseObj) {
        "use strict";
        // The public function name defaults to window.docReady
        // but you can modify the last line of this function to pass in a different object or method name
        // if you want to put them in a different namespace and those will be used instead of
        // window.docReady(...)
        funcName = funcName || "docReady";
        baseObj = baseObj || window;
        var readyList = [];
        var readyFired = false;
        var readyEventHandlersInstalled = false;

        // call this when the document is ready
        // this function protects itself against being called more than once
        function ready() {
            if (!readyFired) {
                // this must be set to true before we start calling callbacks
                readyFired = true;
                for (var i = 0; i < readyList.length; i++) {
                    // if a callback here happens to add new ready handlers,
                    // the docReady() function will see that it already fired
                    // and will schedule the callback to run right after
                    // this event loop finishes so all handlers will still execute
                    // in order and no new ones will be added to the readyList
                    // while we are processing the list
                    readyList[i].fn.call(window, readyList[i].ctx);
                }
                // allow any closures held by these functions to free
                readyList = [];
            }
        }

        function readyStateChange() {
            if ( document.readyState === "complete" ) {
                ready();
            }
        }

        // This is the one public interface
        // docReady(fn, context);
        // the context argument is optional - if present, it will be passed
        // as an argument to the callback
        baseObj[funcName] = function(callback, context) {
            if (typeof callback !== "function") {
                throw new TypeError("callback for docReady(fn) must be a function");
            }
            // if ready has already fired, then just schedule the callback
            // to fire asynchronously, but right away
            if (readyFired) {
                setTimeout(function() {callback(context);}, 1);
                return;
            } else {
                // add the function and context to the list
                readyList.push({fn: callback, ctx: context});
            }
            // if document already ready to go, schedule the ready function to run
            // IE only safe when readyState is "complete", others safe when readyState is "interactive"
            if (document.readyState === "complete" || (!document.attachEvent && document.readyState === "interactive")) {
                setTimeout(ready, 1);
            } else if (!readyEventHandlersInstalled) {
                // otherwise if we don't have event handlers installed, install them
                if (document.addEventListener) {
                    // first choice is DOMContentLoaded event
                    document.addEventListener("DOMContentLoaded", ready, false);
                    // backup is window load event
                    window.addEventListener("load", ready, false);
                } else {
                    // must be IE
                    document.attachEvent("onreadystatechange", readyStateChange);
                    window.attachEvent("onload", ready);
                }
                readyEventHandlersInstalled = true;
            }
        }
    })("metricsReady", window);



    var metrics_cur_page = '';
    try {
        var config = JSON.parse(jsConfig);
        metrics_cur_page = smetrics.getSelectors(config);
    } catch (err) {
        console.log('~994');
    }

    metricsReady(function()
    {
        // if (window.jQuery){
        //     jQuery(document).ajaxSend(function( event, jqxhr, settings ) {
        //         var metrics = event.target.activeElement.form;
        //         if(metrics && metrics.smcache) {

        //             metrics_cur_page.forEach(function(ajax_metrics) {

        //                 smetrics.showlog(metrics, 'ajax_metrics_detected:', smetrics.uslog);

        //                 if( ajax_metrics.smcache == metrics.smcache ){
        //                     smetrics.showlog(ajax_metrics, 'ajax_metrics_in_CRM:', smetrics.uslog);
        //                     smetrics.dataCollection({"target":metrics});
        //                     return 'ajaxSend';
        //                 }
        //             });
        //         }

        //     });
        // }

        var elements;
        var pos;
        var split_selectors;
        var selector;

        var reg = /\s(\d+)metricsReady/;
        for(var i = 0; i < metrics_cur_page.length; i++){
            split_selectors = metrics_cur_page[i].selector.split(reg);

            selector = split_selectors[0];

            smetrics.showlog(selector, 'selector:', smetrics.uslog);

            elements = document.querySelectorAll(selector);

            pos = (split_selectors[1] == undefined)? 0 : split_selectors[1] - 1;

            if(elements[pos] == undefined) {
                continue;
            }


            var smcache = metrics_cur_page[i].smcache;
            var isJs = metrics_cur_page[i].isJs;
            smetrics.showlog(smcache, 'smcache:', smetrics.uslog);

            elements[pos].smcache = smcache;
            elements[pos].smIsJs = isJs;
            // console.log(elements[pos]);


            var standart = 'default';
            // var metrics_id = elements[pos].getAttribute('id');

            if(isJs){
                standart = 'isJs';
            }
            else if(metrics_id = elements[pos].getAttribute('id')){
                if(metrics_id.indexOf('formAcymailing') == 0){
                    standart = 'isAcymailing';
                }
            }

            switch(standart)
            {
                case 'default':
                    elements[pos].addEventListener("submit", function(e){
                        e.preventDefault();
                        // console.log('DEFAULT form sended...');
                        // console.log(e);
                        smetrics.dataCollection(e, function(metrics){
                            if(metrics) {
                                metrics.submit();
                            }
                        });
                    });
                    break;

                case 'isJs':
                    smetrics.showlog(elements[pos], 'this isJs:', smetrics.uslog);
                    break;

                case 'isAcymailing':
                    var sendAcymailing = function(mutationsList) {
                        for(var i = 0; i < mutationsList.length; i++) {
                            if (mutationsList[i].type == 'attributes') {
                                if(mutationsList[i].target.style.display == 'none' || mutationsList[i].target.style.height == '0px'){
                                    this.disconnect();
                                    smetrics.showlog(mutationsList[i].target, 'Acymailing form sended:', smetrics.uslog);
                                    smetrics.dataCollection(mutationsList[i].target);
                                    break;
                                }
                            }
                        }
                    };

                    var observer = new MutationObserver(sendAcymailing);
                    observer.observe(elements[pos], {attributes: true});
                    break;
            }

            smetrics.showlog(elements[pos], 'this elements:', smetrics.uslog);
        }
    });
});
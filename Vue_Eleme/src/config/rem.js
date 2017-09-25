;(function (window,document) {

    var reSize = function () {
        var dpr = Math.floor(window.devicePixelRatio) || 1;
        var html = document.documentElement;
        html.setAttribute('data-dpr',dpr);

        var scael = 1 / dpr;

        var metaEle = document.createElement('meta');
        metaEle.setAttribute('name','viewport');
        metaEle.setAttribute('content','width=device-width,initial-scale=' + scael + ',maximum-scale=' + scael + ',minimum-scale=' + scael + ',user-scalable=no');
        document.head.appendChild(metaEle);
        var rem  = 75;
        if(html.clientWidth < 1242)
        {
            rem = html.clientWidth / 10;
        }
        else
        {
            rem = 108;
        }

        html.style.fontSize = rem + 'px';
        document.body.style.fontSize = 12 * dpr + 'px';
    };
    if(document.addEventListener)
    {
        document.addEventListener('DOMContentLoaded',reSize,false);
        window.addEventListener('orientationchange',reSize,false);
    }
    else
    {
        window.attachEvent('resize',reSize);
        document.onreadystatechange = function () {
            if(document.readyState=='complete')
            {
                reSize();
            }
        }
    }
})(window,document);
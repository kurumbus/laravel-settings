function settings(key, def) {
    o     = settingsData;
    key   = key.replace(/\[(\w+)\]/g, '.$1');
    key   = key.replace(/^\./, '');
    var a = key.split('.');

    for (var i = 0, n = a.length; i < n; ++i) {
        var k = a[i];
        if (k in o) {
            o = o[k];
        } else {
            return;
        }
    }

    if (o == undefined) {
        return def;
    }

    return o;
}

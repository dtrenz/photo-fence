({
    mainConfigFile: '../js/main.js',
    baseUrl: '../js',
    name: 'main',
    out: '../js/main.min.js',
    optimize: 'uglify2',
    preserveLicenseComments: false,
    paths:{
        requireLib: 'vendor/require'
    },
    include: 'requireLib'
})
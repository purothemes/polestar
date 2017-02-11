module.exports = {
    slug: 'polestar',
    jsMinSuffix: '.min',
    version: {
        src: [
            'functions.php',
        ]
    },
    sass: {
        src: [
            'sass/**/*.scss',
        ],
        include: [
            'sass',
        ],
        external: {
            src: [
                'woocommerce/sass/**/*.scss',
            ],
            include: [
                'woocommerce/sass'
            ],
        }        
    },
    js: {
        src: [
            'js/**/*.js',
            'inc/*/js/**/*.js',
            '!inc/customizer-library/js/**',                        // Ignore inc/customizer-library/js/ contents.
            '!{node_modules,node_modules/**}',                      // Ignore node_modules/ and contents.
            '!{tmp,tmp/**}'                                         // Ignore tmp/ and contents.
        ]
    },
    css: {
        src: [
            'style.css',
            'woocommerce.css',
            'css/polestar-icons.css',
        ],
    },      
    copy: {
        src: [
            '**/!(*.js|*.scss|*.md|style.css|woocommerce.css)',     // Everything except .js and .scss files.
            'inc/customizer-library/js/**',                         // Add the unminified inc/customizer-library/js/ contents.
            '!{build,build/**}',                                    // Ignore build/ and contents.
            '!{sass,sass/**}',                                      // Ignore sass/ and contents.
            '!{woocommerce/sass,woocommerce/sass/**}',              // Ignore /woocommerce/sass/ and contents
            '!{tmp,tmp/**}',                                        // Ignore tmp/ and contents.
            '!config.codekit3',                                     // Not the CodeKit file. (If there is one.)
            '!phpunit.xml',                                         // Not the unit tests configuration file. (If there is one.)
            '!functions.php',                                       // Not the functions .php file. It is copied by the 'version' task.
            '!readme.txt',                                          // Not the readme.txt file. It is copied by the 'version' task.
            '!npm-debug.log'                                        // Ignore debug log from NPM if it's there
        ]
    }
};

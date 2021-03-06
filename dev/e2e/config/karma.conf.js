
module.exports = function(config) {
    config.set({
        basePath: '../../../',// path to repo root
        frameworks: ['karma-cukes'],
        files: [
            { pattern: 'src/app/**/*.feature', included: false, watched: true, served: true },
            { pattern: 'dev/e2e/config/step-definitions.js', included: true, watched: true, served: true }
        ],
        client: {
            args: process.argv.slice(4),
            captureConsole: true
        },
        reporters: ['kc-pretty', 'kc-json', 'junit'],
        kcJsonReporter: {
            outputDir: 'dev/e2e/reports',
            outputFile: '{shortBrowserName}.json'
        },
        junitReporter: {
            outputDir: 'dev/e2e/reports',
            outputFile: 'junit.xml',
            useBrowserName: false
        },
        port: 9876,
        colors: true,
        browserConsoleLogOptions: {
            level: 'debug',
            format: '%T: %m',
            terminal: true
        },
        failOnEmptyTestSuite: false,
        logLevel: config.LOG_INFO, // config.LOG_DISABLE || config.LOG_ERROR || config.LOG_WARN || config.LOG_INFO || config.LOG_DEBUG
        urlRoot: "/__karma__/",
        proxies: {
            "/": "http://localhost:8889/"
        },
        browsers: ['PhantomJS'],
        autoWatch: true,
        singleRun: false
    });
};

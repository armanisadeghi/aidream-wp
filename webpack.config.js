const path = require('path');
const webpack = require('webpack');

module.exports = {
    // Entry point of your application
    entry: './src/index.js',

    // Output configuration
    output: {
        path: path.resolve(__dirname, 'dist'),
        filename: 'bundle.js'
    },

    // Module rules for handling different file types
    module: {
        rules: [
            {
                test: /\.js$/, // For JavaScript files
                exclude: /node_modules/,
                use: {
                    loader: 'babel-loader',
                    options: {
                        presets: ['@babel/preset-env', '@babel/preset-react']
                    }
                }
            },
            {
                test: /\.css$/, // For CSS files
                use: ['style-loader', 'css-loader']
            },
            {
                test: /\.(png|svg|jpg|jpeg|gif)$/, // For image files
                type: 'asset/resource'
            }
        ]
    },

    // Development tools (source maps, etc.)
    devtool: 'source-map',

    // Development server configuration
    devServer: {
        static: './dist',
        hot: true
    },

    // Plugins configuration
    plugins: [
        // Add any plugins here
    ]
};

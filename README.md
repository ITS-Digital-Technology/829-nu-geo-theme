# Environment documentation

## Start

When starting a new project, or after cloning an existing project repository perform the following steps:

### Environment configuration

Copy `.env.example` and rename it to `.env`. Fill in the following variables in `.env`:

`DB_NAME`\
`DB_USER`\
`DB_PASS`\
`APP_URL`

`APP_URL` should be a full URL to the website, without `/` at the end (e.g. locally it might be something like `http://localhost/project-name/web`).

### Install dependencies

Run:
```
yarn setup
```

That should install Node and Composer dependencies, and perform WordPress installation (it adds a `wpdev` user with password - `qwe123EWQ#@!`).

Alternatively you can install dependencies yourself by running:
```
yarn
composer install
```

### Import database

If you've cloned an existing project containing a database export you can import it by running:
```
gulp db:import
```
That will import file named `db.sql`. If you want to import a different file you can specify it like so:
```
gulp db:import --file=data
```
Which will import `data.sql`.

Note that the filename passed as `--file` parameter should be without extension. All database export files should be located in `db` folder.

### Configure webpack

If you're starting a new project configure the path to the main JS file in `webpack.config.js` (`themeAt` variable).

## Working on a project

Install the theme to `web/app/themes`, then simply run:
```
gulp
```

That will compile styles and scripts, and watch for changes:
* `*.scss` and `*.sass` files placed in `src` directory will be compiled into `web` retaining the folder structure.
* Scripts will be compiled according to settings from `webpack.config.js`. Default configuration places the source file in `src` directory and compiled file in `web`.

## Installing WordPress plugins

Find the plugin on [https://wpackagist.org/](https://wpackagist.org/). To install it run:
```
composer require wpackagist-plugin/plugin-name
```
For example, for WooCommerce:
```
composer require wpackagist-plugin/woocommerce
```

If the plugin is not available on wpackagist (e.g. it's a paid plugin), then put the files in `packages` folder - in a subfolder. Subfolder can be named anything, but for clarity it's best to give it the same name as the plugin. E.g. for Gravity Forms that would be:
```
packages
  gravityforms
    gravityforms
      ...files here...
```

Inside the plugin folder itself add `composer.json` file with the following content:
```json
{
    "name": "gravityforms/gravityforms",
    "version": "X.Y.Z",
    "type": "wordpress-plugin"
}
```
Ensure the following:
* `name` is just a subfolder/plugin folder inside `package`.
* `type` should **always** be `wordpress-plugin`.
* `version` should reflect the version of the plugin (so it would be something like `4.1.3` instead of `X.Y.Z`).

Above is the example for Gravity Forms.

Then you require it like any other Composer plugin.
```text
composer require gravityforms/gravityforms:^X.Y.Z
```

For example, if you install Gravity Forms 4.1.3, you'd do:
```text
composer require gravityforms/gravityforms:^4.1.3
```

<details>
<summary>What does "^" in version mean?</summary>

`^4.1.3` tells Composer to install at least version `4.1.3`, but any higher is accepted too (so we can upgrade the plugin!), but it mus be lower than `5.0.0`. Plugins with different major version (first number) might not be compatible with each other, so upgrading from `4.X.X` to `5.0.0` might break things. Read more about versions on [Composer website](https://getcomposer.org/doc/articles/versions.md).
</details>


If you need to upload new version of the plugin you have to additionally change the version in the _plugins_ `composer.json` to the new one before running:
```text
composer update
```

<details>
<summary>Why?</summary>

When determining if the plugin needs updating Composer looks at the plugins `composer.json` file. If the version is the same as currently installed Composer will not re-install the plugin. So if you update plugins files, but not the version in `composer.json` Composer will thing that nothing has changed.
</details>

### Adding custom plugins

If you add a custom plugin that you change during development, the process is essentially the same as above, but you have to come up with the version number and change it whenever you make changes to the plugin, before running `composer update`.

Start with `1.0.0`, change the last number every time you _fix a bug_, middle number every time you _add a feature_, and the first number if you introduce major changes that are not compatible with what's been going on so far.

Read more about [Semanting Versioning](https://semver.org/).

## Available gulp tasks

```
gulp
```
Builds the project and watches for changes.

```
gulp build
```
Builds the project.

```
gulp build --production
```
Builds the project with production settings - minifies all the assets. You can also use `--production` flag with other tasks to make a production build.

```
gulp watch
```
Watches scripts and styles for changes.

```
gulp install
gulp wp-install
```
Installs WordPress (not in the `web` folder, performs actuall WordPress intallation - as in - fills DB tables with initial data). It creates `wpdev` user with password - `qwe123EWQ#@!`.

```
gulp styles
```
Compiles styles (`.scss`, `.sass`) from the `src` folder, outputting the compiled `.css` files to `web` with the same directory structure.

```
gulp styles:watch
```
Watches for changes in styles.

```
gulp scripts
```
Compiles scripts using webpack. The configuration is in `webpack.config.js`.

```
gulp scripts:watch
```
Watches scripts for changes.

```
gulp browsersync
```
Launches [Browsersync](https://browsersync.io/).

```
gulp db:export
```
Creates `db.sql` file in `db` folder containing the export of the database.

```
gulp db:export --file=filename
```
Creates `filename.sql` file in `db` folder containing the export of the database.

```
gulp db:import
```
Imports `db.sql` (located in `db` folder) and **replaces your database** with the contents.

```
gulp db:import --file=filename
```
Imports `filename.sql` (located in `db` folder) and **replaces your databse** with the contents.

## Other tools

### package.json scripts

```
yarn setup
```
Installs all dependencies and installs WordPress.

```
yarn filepack
```
Creates a zip file (`web/filepack.zip`) containing theme, plugins, and uploads.

```
yarn filepack-full
```
Creates a zip file (`web/filepack-full.zip`) containing the entire environment.

```
yarn build
```
Builds a production version of the project (alias for `gulp build --production`, useful when you don't have gulp available globally).

```
yarn db-import
```
Imports `db.sql` (alias for `gulp db:import`, useful when you don't have gulp available globally).

### WP-CLI

[WP-CLI](https://wp-cli.org/) is installed, and configured. Run WP-CLI commands like so:
```
vendor/bin/wp command
```

### Ant Buildfile

The environment comes with an Ant Buildfile (`build.xml`), so the project can be built with [Ant](https://ant.apache.org/), for example:
```
ant build
```

# AntiExplosions

AntiExplosions prevents entity explosions from breaking blocks in the worlds selected by the server configuration.

[![Build](https://github.com/NhanAZ-Plugins/AntiExplosions/actions/workflows/build.yml/badge.svg)](https://github.com/NhanAZ-Plugins/AntiExplosions/actions/workflows/build.yml)

## Requirements and compatibility

- An Axolotl-PM server with plugin API 5.0.0. The exact server source revision used for CI is pinned in the [build workflow](.github/workflows/build.yml).
- PHP 8.1 or newer with the extensions required by Axolotl-PM.

The minimum server patch release and compatibility across every Axolotl-PM 5.x release have not been established independently. The API declaration in [plugin.yml](plugin.yml) remains at 5.0.0.

## Installation

1. Download `AntiExplosions.phar` from the [v1.0.4 release](https://github.com/NhanAZ-Plugins/AntiExplosions/releases/tag/v1.0.4).
2. Place the PHAR in the server's `plugins` directory.
3. Start the server to generate `config.yml`, then stop it before editing the configuration.
4. Restart the server after changing the configuration.

## Configuration and behavior

| Setting | Default | Effect |
|---|---|---|
| `Mode` | `all` | `all` prevents block breaking in every world. `whitelist` applies only to listed worlds. `blacklist` applies to all worlds except listed worlds. |
| `Worlds` | `[]` | World display names used by whitelist and blacklist mode. Matching is case sensitive. |

The plugin handles `EntityPreExplodeEvent` and sets block breaking to false in selected worlds. It does not cancel the explosion event or claim to suppress every other effect of the explosion. An invalid `Mode` value falls back to `all`. If `Worlds` is not a list, it is treated as empty.

## Build and validation

CI uses [DevTools v1.0.1](https://github.com/NhanAZ/DevTools/releases/tag/v1.0.1) with a pinned Axolotl-PM source revision. It runs PHPStan level max, lints the source, builds a standalone PHAR, checks the included manifest, source, configuration and license, then uploads the artifact with build metadata.

For a local build with that DevTools release, run:

```sh
php -d phar.readonly=0 path/to/DevTools/bin/devtools.php build --project=. --out=build
```

A successful PHAR build checks packaging. A clean server boot checks plugin loading. Testing block destruction behavior still requires an explosion on a test server.

## Upgrade and rollback

Version 1.0.4 keeps the existing configuration keys. It validates the world list and defaults an unknown mode to `all`. Save the existing PHAR and `config.yml` before upgrading. Stop the server before replacing the PHAR. Restore those files if the fallback behavior does not suit your configuration. See [CHANGELOG.md](CHANGELOG.md).

## License and support

The source retains its existing [GNU GPL version 3 license](LICENSE). For support, open a GitHub issue or use [NhanAZ Discord](https://discord.gg/j2X83ujT6c).

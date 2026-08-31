import antfu from '@antfu/eslint-config'

export default antfu({
  formatters: true,
  vue: true,
  ignores: [
    '*.md',
    'resources/ts/actions/**',
    'resources/ts/routes/**',
    'resources/ts/wayfinder/**',
  ],
  rules: {
    'markdown/no-multiple-h1': 'off',
    // Autofix adds `trustPolicy: no-downgrade`, which makes pnpm reject the
    // committed lockfile and breaks every `pnpm run` until it is rebuilt.
    'pnpm/yaml-enforce-settings': 'off',
  },
})

import antfu from '@antfu/eslint-config'

export default antfu({
  formatters: true,
  vue: true,
  ignores: [
    'resources/ts/actions/**',
    'resources/ts/routes/**',
    'resources/ts/wayfinder/**',
  ],
  rules: {
    'markdown/no-multiple-h1': 'off',
  },
})

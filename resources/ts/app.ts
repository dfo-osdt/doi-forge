import type { DefineComponent } from 'vue'
import { createInertiaApp, router } from '@inertiajs/vue3'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'
import { createApp, h } from 'vue'
import { initializeTheme } from '@/composables/useAppearance'
import { i18n, setLocale } from '@/plugins/i18n'
import '../css/app.css'

const appName = import.meta.env.VITE_APP_NAME || 'Laravel'

createInertiaApp({
  title: title => (title ? `${title} - ${appName}` : appName),
  resolve: name =>
    resolvePageComponent(
      `./pages/${name}.vue`,
      import.meta.glob<DefineComponent>('./pages/**/*.vue'),
    ),
  setup({ el, App, props, plugin }) {
    const initialLocale = props.initialPage.props.locale as string
    if (initialLocale) {
      setLocale(initialLocale)
    }

    createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(i18n)
      .mount(el)
  },
  progress: {
    color: '#4B5563',
  },
})

// Sync locale from Inertia shared props on every successful request
router.on('success', (event) => {
  const locale = event.detail.page.props.locale as string
  if (locale)  {
    setLocale(locale)
  }
})

// This will set light / dark mode on page load...
initializeTheme()

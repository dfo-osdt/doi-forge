import type { App, WritableComputedRef } from 'vue'
import { createI18n } from 'vue-i18n'
import en from '@/locales/en.json'
import fr from '@/locales/fr.json'

type MessageSchema = typeof en

export const i18n = createI18n<[MessageSchema], 'en' | 'fr'>({
  legacy: false,
  globalInjection: true,
  fallbackLocale: 'en',
  locale: 'en',
  messages: { en, fr },
})

export function setLocale(locale: string): void {
  (i18n.global.locale as unknown as WritableComputedRef<string>).value = locale
}

export function installI18n(app: App<Element>): void {
  app.use(i18n)
}

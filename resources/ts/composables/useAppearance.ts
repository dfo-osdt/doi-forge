import type { Component, ComputedRef, Ref } from 'vue'
import type { Appearance, ResolvedAppearance } from '@/types'
import { Monitor, Moon, Sun } from 'lucide-vue-next'
import { computed, onMounted, ref } from 'vue'
import { useI18n } from 'vue-i18n'

export type { Appearance, ResolvedAppearance }

export interface AppearanceOption {
  value: Appearance
  Icon: Component
  label: string
}

export interface UseAppearanceReturn {
  appearance: Ref<Appearance>
  resolvedAppearance: ComputedRef<ResolvedAppearance>
  options: ComputedRef<AppearanceOption[]>
  activeIcon: ComputedRef<Component>
  updateAppearance: (value: Appearance) => void
}

export function updateTheme(value: Appearance): void {
  if (typeof window === 'undefined') {
    return
  }

  if (value === 'system') {
    const mediaQueryList = window.matchMedia(
      '(prefers-color-scheme: dark)',
    )
    const systemTheme = mediaQueryList.matches ? 'dark' : 'light'

    document.documentElement.classList.toggle(
      'dark',
      systemTheme === 'dark',
    )
  }
  else {
    document.documentElement.classList.toggle('dark', value === 'dark')
  }
}

function setCookie(name: string, value: string, days = 365) {
  if (typeof document === 'undefined') {
    return
  }

  const maxAge = days * 24 * 60 * 60

  document.cookie = `${name}=${value};path=/;max-age=${maxAge};SameSite=Lax`
}

function mediaQuery() {
  if (typeof window === 'undefined') {
    return null
  }

  return window.matchMedia('(prefers-color-scheme: dark)')
}

function getStoredAppearance() {
  if (typeof window === 'undefined') {
    return null
  }

  return localStorage.getItem('appearance') as Appearance | null
}

function prefersDark(): boolean {
  if (typeof window === 'undefined') {
    return false
  }

  return window.matchMedia('(prefers-color-scheme: dark)').matches
}

function handleSystemThemeChange() {
  const currentAppearance = getStoredAppearance()

  updateTheme(currentAppearance || 'system')
}

export function initializeTheme(): void {
  if (typeof window === 'undefined') {
    return
  }

  // Initialize theme from saved preference or default to system...
  const savedAppearance = getStoredAppearance()
  updateTheme(savedAppearance || 'system')

  // Set up system theme change listener...
  mediaQuery()?.addEventListener('change', handleSystemThemeChange)
}

const appearance = ref<Appearance>('system')

export function useAppearance(): UseAppearanceReturn {
  const { t } = useI18n()

  onMounted(() => {
    const savedAppearance = localStorage.getItem(
      'appearance',
    ) as Appearance | null

    if (savedAppearance) {
      appearance.value = savedAppearance
    }
  })

  const resolvedAppearance = computed<ResolvedAppearance>(() => {
    if (appearance.value === 'system') {
      return prefersDark() ? 'dark' : 'light'
    }

    return appearance.value
  })

  const options = computed<AppearanceOption[]>(() => [
    { value: 'light', Icon: Sun, label: t('appearance.light') },
    { value: 'dark', Icon: Moon, label: t('appearance.dark') },
    { value: 'system', Icon: Monitor, label: t('appearance.system') },
  ])

  const activeIcon = computed<Component>(
    () => options.value.find(o => o.value === appearance.value)?.Icon ?? Monitor,
  )

  function updateAppearance(value: Appearance) {
    appearance.value = value

    // Store in localStorage for client-side persistence...
    localStorage.setItem('appearance', value)

    // Store in cookie for SSR...
    setCookie('appearance', value)

    updateTheme(value)
  }

  return {
    appearance,
    resolvedAppearance,
    options,
    activeIcon,
    updateAppearance,
  }
}

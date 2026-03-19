<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3'
import { useI18n } from 'vue-i18n'
import AppearanceToggle from '@/components/AppearanceToggle.vue'
import AppLogoIcon from '@/components/AppLogoIcon.vue'
import LocaleSwitcher from '@/components/LocaleSwitcher.vue'
import { dashboard, login, register } from '@/routes'

withDefaults(
  defineProps<{
    canRegister?: boolean
  }>(),
  {
    canRegister: true,
  },
)

const { t } = useI18n()
</script>

<template>
  <Head title="Welcome">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
      href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=IBM+Plex+Mono:wght@400;500&display=swap"
      rel="stylesheet"
    >
  </Head>

  <div class="relative flex min-h-screen flex-col overflow-hidden bg-background text-foreground">
    <!-- Subtle dot-grid background -->
    <div
      class="pointer-events-none absolute inset-0 opacity-[0.04] dark:opacity-[0.03]"
      style="background-image: radial-gradient(circle, hsl(var(--foreground)) 1px, transparent 1px); background-size: 28px 28px;"
    />

    <!-- Header -->
    <header class="relative z-10 flex items-center justify-between px-6 py-5 lg:px-10">
      <div
        class="select-none text-[11px] tracking-[0.25em] text-muted-foreground/30 uppercase"
        style="font-family: 'IBM Plex Mono', monospace;"
        aria-hidden="true"
      >
        10.XXXX/doi-primary
      </div>
      <nav class="flex items-center gap-2">
        <template v-if="$page.props.auth.user">
          <Link
            :href="dashboard()"
            class="inline-flex items-center rounded-sm border border-primary/40 px-4 py-1.5 text-sm text-foreground transition-colors duration-150 hover:border-primary"
          >
            {{ t('welcome.dashboard') }}
          </Link>
        </template>
        <template v-else>
          <Link
            :href="login()"
            class="inline-flex items-center rounded-sm border border-transparent px-4 py-1.5 text-sm text-foreground transition-colors duration-150 hover:border-primary/40"
          >
            {{ t('log-in') }}
          </Link>
          <Link
            v-if="canRegister"
            :href="register()"
            class="inline-flex items-center rounded-sm border border-primary/40 px-4 py-1.5 text-sm text-foreground transition-colors duration-150 hover:border-primary"
          >
            {{ t('register') }}
          </Link>
        </template>
        <AppearanceToggle />
        <LocaleSwitcher />
      </nav>
    </header>

    <!-- Main -->
    <main class="relative z-10 flex flex-1 flex-col items-center justify-center px-6 py-16 text-center">
      <!-- Decorative rule -->
      <div class="mb-10 flex items-center gap-5" aria-hidden="true">
        <div class="h-px w-20 bg-linear-to-r from-transparent via-primary/30 to-primary/50" />
        <AppLogoIcon class="size-14 text-primary" />
        <div class="h-px w-20 bg-linear-to-l from-transparent via-primary/30 to-primary/50" />
      </div>

      <!-- Wordmark -->
      <h1
        class="mb-6 text-[clamp(4rem,12vw,8rem)] leading-none tracking-tight text-foreground"
        style="font-family: 'DM Serif Display', serif;"
      >
        DOI Forge
      </h1>

      <!-- Tagline -->
      <p class="mb-12 max-w-lg text-base leading-relaxed text-muted-foreground">
        {{ t('welcome.tagline') }}
      </p>

      <!-- CTA -->
      <template v-if="$page.props.auth.user">
        <Link
          :href="dashboard()"
          class="inline-flex items-center rounded-sm border border-primary/40 px-8 py-3 text-sm text-foreground transition-colors duration-150 hover:border-primary"
        >
          {{ t('welcome.dashboard') }}
        </Link>
      </template>
      <template v-else>
        <Link
          :href="login()"
          class="inline-flex items-center rounded-sm border border-primary/40 px-8 py-3 text-sm text-foreground transition-colors duration-150 hover:border-primary"
        >
          {{ t('log-in') }}
        </Link>
      </template>
    </main>

    <!-- Footer -->
    <footer class="relative z-10 px-6 py-5 text-center lg:px-10">
      <div
        class="text-[10px] tracking-[0.3em] text-muted-foreground"
        style="font-family: 'IBM Plex Mono', monospace;"
      >
        v0.0.0
      </div>
    </footer>
  </div>
</template>

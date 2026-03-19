export interface UseInitialsReturn {
  getInitials: (firstName?: string, lastName?: string) => string
}

export function getInitials(firstName?: string, lastName?: string): string {
  const first = firstName?.trim().charAt(0).toUpperCase() ?? ''
  const last = lastName?.trim().charAt(0).toUpperCase() ?? ''

  return `${first}${last}`
}

export function useInitials(): UseInitialsReturn {
  return { getInitials }
}

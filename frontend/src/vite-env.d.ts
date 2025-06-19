/// <reference types="vite/client" />
interface ImportMetaEnv {
  readonly vite: string
  // add more as needed
}

interface ImportMeta {
  readonly env: ImportMetaEnv
}
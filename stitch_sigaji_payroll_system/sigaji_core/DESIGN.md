---
name: SiGaji Core
colors:
  surface: '#f8f9ff'
  surface-dim: '#cbdbf5'
  surface-bright: '#f8f9ff'
  surface-container-lowest: '#ffffff'
  surface-container-low: '#eff4ff'
  surface-container: '#e5eeff'
  surface-container-high: '#dce9ff'
  surface-container-highest: '#d3e4fe'
  on-surface: '#0b1c30'
  on-surface-variant: '#414845'
  inverse-surface: '#213145'
  inverse-on-surface: '#eaf1ff'
  outline: '#717975'
  outline-variant: '#c1c8c3'
  surface-tint: '#416658'
  primary: '#001810'
  on-primary: '#ffffff'
  primary-container: '#062e23'
  on-primary-container: '#719788'
  inverse-primary: '#a7cfbf'
  secondary: '#3c6a00'
  on-secondary: '#ffffff'
  secondary-container: '#aaf859'
  on-secondary-container: '#407100'
  tertiary: '#0a1510'
  on-tertiary: '#ffffff'
  tertiary-container: '#1f2a25'
  on-tertiary-container: '#85928a'
  error: '#ba1a1a'
  on-error: '#ffffff'
  error-container: '#ffdad6'
  on-error-container: '#93000a'
  primary-fixed: '#c3ebda'
  primary-fixed-dim: '#a7cfbf'
  on-primary-fixed: '#002117'
  on-primary-fixed-variant: '#294e41'
  secondary-fixed: '#aaf859'
  secondary-fixed-dim: '#90db3f'
  on-secondary-fixed: '#0e2000'
  on-secondary-fixed-variant: '#2c5000'
  tertiary-fixed: '#d9e6dd'
  tertiary-fixed-dim: '#bdcac1'
  on-tertiary-fixed: '#131e19'
  on-tertiary-fixed-variant: '#3e4943'
  background: '#f8f9ff'
  on-background: '#0b1c30'
  surface-variant: '#d3e4fe'
  status-success: '#10B981'
  status-error: '#EF4444'
  status-warning: '#F59E0B'
  surface-bg: '#F8FAFC'
  border-muted: '#E2E8F0'
typography:
  display-lg:
    fontFamily: Manrope
    fontSize: 48px
    fontWeight: '800'
    lineHeight: 56px
    letterSpacing: -0.02em
  headline-lg:
    fontFamily: Manrope
    fontSize: 32px
    fontWeight: '700'
    lineHeight: 40px
  headline-lg-mobile:
    fontFamily: Manrope
    fontSize: 24px
    fontWeight: '700'
    lineHeight: 32px
  headline-md:
    fontFamily: Manrope
    fontSize: 24px
    fontWeight: '600'
    lineHeight: 32px
  body-lg:
    fontFamily: Hanken Grotesk
    fontSize: 18px
    fontWeight: '400'
    lineHeight: 28px
  body-md:
    fontFamily: Hanken Grotesk
    fontSize: 16px
    fontWeight: '400'
    lineHeight: 24px
  body-sm:
    fontFamily: Hanken Grotesk
    fontSize: 14px
    fontWeight: '400'
    lineHeight: 20px
  label-md:
    fontFamily: Hanken Grotesk
    fontSize: 14px
    fontWeight: '600'
    lineHeight: 16px
    letterSpacing: 0.05em
  mono-data:
    fontFamily: Hanken Grotesk
    fontSize: 14px
    fontWeight: '500'
    lineHeight: 20px
rounded:
  sm: 0.125rem
  DEFAULT: 0.25rem
  md: 0.375rem
  lg: 0.5rem
  xl: 0.75rem
  full: 9999px
spacing:
  base: 4px
  container-margin: 24px
  gutter: 16px
  table-cell-px: 16px
  table-cell-py: 12px
  stack-sm: 8px
  stack-md: 16px
  stack-lg: 32px
---

## Brand & Style

The design system for this employee payroll information system is anchored in a **Corporate / Modern** aesthetic that emphasizes trust, precision, and efficiency. It is designed to transform a traditionally tedious administrative task into a streamlined, high-clarity experience.

The visual narrative uses a "Money & Growth" metaphor, utilizing deep forest greens for stability and bright lime accents for modern vitality. The interface prioritizes high information density for administrative workflows while maintaining a sophisticated, editorial feel for payslips and employee-facing dashboards. The style is clean and functional, utilizing ample white space, sharp borders, and a systematic grid to ensure data remains the focal point.

Targeting both HR administrators and general employees, the UI evokes a sense of reliability and professional transparency. It balances the "industrial" nature of payroll management with the "approachable" nature of a modern SaaS tool.

## Colors

The palette is derived from the brand's identity, focusing on a high-contrast professional green scale.

- **Primary (#062E23):** A deep, authoritative "Forest Green" used for primary navigation, headings, and high-importance UI anchors. It represents the "Stability" of the financial system.
- **Secondary (#86D035):** An energetic "Lime Green" used for primary actions (CTAs), focus states, and highlighting growth or positive financial indicators.
- **Tertiary (#F0FDF4):** A very soft mint tint used for backgrounds of positive status labels, table row highlights, and container backgrounds to add depth without adding weight.
- **Neutral (#64748B):** A professional slate gray used for body text, secondary icons, and UI borders to maintain a "SaaS-native" look.

The system uses a `light` default mode to maximize legibility for dense data tables and printed payslips.

## Typography

This design system employs a dual-font strategy to balance modernity with readability. 

**Manrope** is used for headlines and display text. Its geometric structure provides a high-tech, modern feel that commands attention for total amounts and section headers. 

**Hanken Grotesk** is the workhorse for all body copy, tables, and labels. It offers exceptional legibility at small sizes, which is critical for payroll tables and line-item details on payslips.

For payslips, a clear hierarchy is established: headers use semi-bold weights, while financial values are given priority through slightly larger sizes or the `mono-data` style to ensure vertical alignment of digits.

## Layout & Spacing

This design system utilizes a **12-column fixed grid** for desktop, centered within a max-width container of 1280px. This ensures that even on ultra-wide monitors, data tables remain readable and don't stretch excessively.

- **Admin Tables:** Designed for high density. Vertical padding is kept tight (`table-cell-py: 12px`) to allow more rows per screen, minimizing scrolling for HR managers.
- **Mobile Adaptive:** On mobile, the 12-column grid collapses to 1 column. Horizontal margins are reduced to 16px. Tables transition to "card-stack" views if columns exceed 4, ensuring data integrity on small screens.
- **Rhythm:** A 4px base unit governs all spacing, ensuring consistent alignment across all components.

## Elevation & Depth

To maintain a professional, corporate feel, depth is conveyed through **Tonal Layers** and **Low-Contrast Outlines** rather than heavy shadows.

- **Surface Levels:** The primary background is light gray (`#F8FAFC`). Cards and content containers use pure white backgrounds to "pop" against the base.
- **Borders:** Instead of shadows, UI containers are defined by 1px solid borders in `border-muted` (`#E2E8F0`).
- **Interactive Depth:** When a user hovers over a table row or a card, a subtle background tint (`tertiary_color`) is applied rather than an elevation lift.
- **Modals:** Only high-priority overlays (like "Generate Payroll" confirmation) use a diffused, 15% opacity shadow with no tint to focus the user's attention.

## Shapes

The shape language is **Soft (0.25rem)**. This subtle rounding provides a modern touch without sacrificing the professional, "square" feel expected of a financial application. 

- **Primary Buttons:** Use the standard `0.25rem` (4px) corner radius.
- **Input Fields:** Maintain the 4px radius to feel structured and precise.
- **Pills/Status Labels:** These are the exception, using full-round caps (pill-shaped) to distinguish them from interactive buttons or input fields at a glance.

## Components

### Buttons
- **Primary:** Background `primary_color_hex`, text white. On hover, background shifts to a slightly lighter tint.
- **Secondary/Action:** Background `secondary_color_hex`, text `primary_color_hex`. High visibility for "Generate Gaji" or "Print" actions.
- **Ghost:** No background, border `border-muted`, text `neutral_color_hex`. Used for secondary navigation or cancel actions.

### Data Tables (Admin)
- **Header:** Background `surface-bg`, text `label-md` (uppercase), `primary_color_hex`.
- **Rows:** Alternating subtle stripes or simple white rows with `border-muted` bottom dividers.
- **Cells:** `body-sm` for standard data, `mono-data` for currency values.

### Input Fields
- White background, 1px border `border-muted`. On focus, the border changes to `secondary_color_hex` with a 2px outer glow of the same color at 20% opacity.

### Payslip Cards (Employee View)
- Use a "document" metaphor. High contrast between labels and values. Use `headline-md` for the "Gaji Bersih" (Net Pay) value to ensure it is the first thing an employee sees.

### Chips/Badges
- **Status Selesai:** Background `tertiary_color_hex`, text `status-success`.
- **Status Diproses:** Background blue-50, text blue-600.
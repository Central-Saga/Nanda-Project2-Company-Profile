interface SubmitButtonProps {
  label?: string;
  pendingLabel?: string;
  pending?: boolean;
  variant?: "primary" | "danger";
}

export function SubmitButton({
  label = "Simpan",
  pendingLabel = "Menyimpan...",
  pending = false,
  variant = "primary",
}: SubmitButtonProps) {
  const base = "px-4 py-2 text-sm font-medium rounded transition focus:outline-none focus:ring-2 disabled:opacity-50";
  const colors = variant === "danger"
    ? "bg-red-800 hover:bg-red-900 text-red-100 focus:ring-red-700"
    : "bg-red-600 hover:bg-red-700 text-white focus:ring-red-500";

  return (
    <button type="submit" disabled={pending} className={`${base} ${colors}`}>
      {pending ? pendingLabel : label}
    </button>
  );
}

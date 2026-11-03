interface FormFieldProps {
  label: string;
  name: string;
  type?: string;
  required?: boolean;
  placeholder?: string;
  defaultValue?: string;
  errors?: string[];
  multiline?: boolean;
  rows?: number;
  hint?: string;
}

export function FormField({
  label,
  name,
  type = "text",
  required = false,
  placeholder,
  defaultValue,
  errors,
  multiline = false,
  rows = 3,
  hint,
}: FormFieldProps) {
  const inputClass =
    "w-full px-3 py-2 bg-zinc-900 border border-zinc-800 text-zinc-100 rounded text-sm focus:outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600";

  return (
    <div>
      <label
        className="block text-xs font-mono uppercase tracking-wider text-zinc-400 mb-1"
        htmlFor={name}
      >
        {label}
        {required && <span className="text-red-500 ml-0.5">*</span>}
      </label>
      {hint && <p className="text-[11px] text-zinc-500 mb-1">{hint}</p>}
      {multiline ? (
        <textarea
          id={name}
          name={name}
          required={required}
          placeholder={placeholder}
          defaultValue={defaultValue}
          rows={rows}
          className={inputClass}
        />
      ) : (
        <input
          id={name}
          name={name}
          type={type}
          required={required}
          placeholder={placeholder}
          defaultValue={defaultValue}
          className={inputClass}
        />
      )}
      {errors?.map((err, i) => (
        <p key={i} className="mt-1 text-xs text-red-400">
          {err}
        </p>
      ))}
    </div>
  );
}

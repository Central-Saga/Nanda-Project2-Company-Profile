"use client";

import { useState } from "react";

export function TerminalCopy({ command }: { command: string }) {
  const [copied, setCopied] = useState(false);

  const handleCopy = async () => {
    try {
      await navigator.clipboard.writeText(command);
      setCopied(true);
      setTimeout(() => setCopied(false), 2000);
    } catch {
      // fallback
    }
  };

  return (
    <div className="inline-flex items-center gap-3 px-4 py-2.5 rounded bg-zinc-950 border border-zinc-800 text-xs font-mono text-zinc-300 shadow-xl group hover:border-zinc-700 transition">
      <span className="text-red-500 select-none">$</span>
      <span className="text-zinc-100 font-medium tracking-tight">{command}</span>
      <button
        onClick={handleCopy}
        type="button"
        className="ml-2 px-2 py-0.5 rounded text-[10px] uppercase font-mono tracking-wider bg-zinc-900 hover:bg-zinc-800 text-zinc-400 hover:text-zinc-100 border border-zinc-800 transition"
      >
        {copied ? "COPIED!" : "COPY"}
      </button>
    </div>
  );
}

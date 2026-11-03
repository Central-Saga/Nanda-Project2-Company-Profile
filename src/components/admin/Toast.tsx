"use client";

import { useEffect, useRef } from "react";

interface ToastProps {
  message: string;
  type: "success" | "error";
  onClose: () => void;
}

export function Toast({ message, type, onClose }: ToastProps) {
  const ref = useRef<HTMLDivElement>(null);

  useEffect(() => {
    const timer = setTimeout(onClose, 4000);
    return () => clearTimeout(timer);
  }, [onClose]);

  const bg = type === "success" ? "bg-green-950/80 border-green-700/50 text-green-300" : "bg-red-950/80 border-red-700/50 text-red-300";

  return (
    <div
      ref={ref}
      role="alert"
      className={`fixed bottom-6 right-6 z-50 px-4 py-3 border rounded text-sm font-mono ${bg}`}
    >
      {message}
    </div>
  );
}

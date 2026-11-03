import { getCurrentUser } from "@/lib/auth";
import { redirect } from "next/navigation";
import Link from "next/link";
import { LogoutButton } from "./LogoutButton";

export default async function AdminLayout({
  children,
}: {
  children: React.ReactNode;
}) {
  const user = await getCurrentUser();

  if (!user) {
    redirect("/admin/login");
  }

  if (user.mustChangePassword) {
    redirect("/admin/change-password");
  }

  const navItems = [
    { label: "Dashboard", href: "/admin/dashboard" },
    { label: "Profil & Brand", href: "/admin/profile" },
    { label: "Layanan", href: "/admin/services" },
    { label: "Portofolio", href: "/admin/portfolio" },
    { label: "Blog", href: "/admin/blog" },
    { label: "Karir", href: "/admin/careers" },
    { label: "Leads & Brief", href: "/admin/leads" },
    { label: "Konsultasi", href: "/admin/bookings" },
    { label: "Media Library", href: "/admin/media" },
    { label: "Audit Log", href: "/admin/audit-logs" },
  ];

  return (
    <div className="min-h-screen bg-black text-zinc-100 flex">
      {/* Sidebar */}
      <aside className="w-64 border-r border-zinc-900 bg-zinc-950 flex flex-col shrink-0">
        <div className="p-4 border-b border-zinc-900">
          <div className="flex items-center gap-2">
            <span className="w-2.5 h-2.5 rounded-full bg-red-600 inline-block animate-pulse"></span>
            <span className="font-mono text-xs font-bold uppercase tracking-wider text-zinc-200">
              Admin Console
            </span>
          </div>
        </div>

        <nav className="flex-1 p-3 space-y-1 overflow-y-auto">
          {navItems.map((item) => (
            <Link
              key={item.href}
              href={item.href}
              className="flex items-center px-3 py-2 text-xs font-mono rounded text-zinc-400 hover:text-zinc-100 hover:bg-zinc-900 transition"
            >
              {item.label}
            </Link>
          ))}
        </nav>

        <div className="p-4 border-t border-zinc-900 bg-zinc-950/50">
          <div className="text-xs font-medium text-zinc-200 truncate">{user.fullName}</div>
          <div className="text-[11px] font-mono text-zinc-500 truncate mb-3">{user.email}</div>
          <LogoutButton />
        </div>
      </aside>

      {/* Main Content Area */}
      <div className="flex-1 flex flex-col min-w-0">
        <header className="h-14 border-b border-zinc-900 bg-zinc-950/40 px-6 flex items-center justify-between">
          <div className="text-xs font-mono text-zinc-400">
            Peran: <span className="text-zinc-200 uppercase">{user.role}</span>
          </div>
          <div className="text-xs font-mono text-zinc-500">
            Status: <span className="text-green-500">Aktif</span>
          </div>
        </header>

        <main className="flex-1 p-6 overflow-y-auto bg-black">{children}</main>
      </div>
    </div>
  );
}

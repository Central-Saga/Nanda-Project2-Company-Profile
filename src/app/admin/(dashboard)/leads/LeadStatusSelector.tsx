"use client";

import { useTransition } from "react";
import { updateLeadStatusAction } from "@/app/actions/crm";
import type { LeadStatus } from "@prisma/client";

export function LeadStatusSelector({
  leadId,
  currentStatus,
}: {
  leadId: string;
  currentStatus: LeadStatus;
}) {
  const [isPending, startTransition] = useTransition();

  function handleChange(e: React.ChangeEvent<HTMLSelectElement>) {
    const newStatus = e.target.value as LeadStatus;
    startTransition(async () => {
      await updateLeadStatusAction(leadId, newStatus);
    });
  }

  return (
    <select
      defaultValue={currentStatus}
      disabled={isPending}
      onChange={handleChange}
      className="px-2 py-1 bg-zinc-900 border border-zinc-800 text-zinc-200 rounded text-[11px] font-mono focus:outline-none focus:border-red-600 disabled:opacity-50"
    >
      <option value="new">NEW</option>
      <option value="contacted">CONTACTED</option>
      <option value="qualified">QUALIFIED</option>
      <option value="proposal_sent">PROPOSAL SENT</option>
      <option value="negotiation">NEGOTIATION</option>
      <option value="won">WON</option>
      <option value="lost">LOST</option>
      <option value="junk">JUNK</option>
    </select>
  );
}

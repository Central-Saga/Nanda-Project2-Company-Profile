import { S3Client, PutObjectCommand, DeleteObjectCommand, GetObjectCommand } from "@aws-sdk/client-s3";

const endpoint = process.env.S3_ENDPOINT || "http://localhost:9000";
const region = process.env.S3_REGION || "us-east-1";
const accessKeyId = process.env.S3_ACCESS_KEY_ID || "minioadmin";
const secretAccessKey = process.env.S3_SECRET_ACCESS_KEY || "minioadmin";
export const S3_BUCKET = process.env.S3_BUCKET || "compro-uploads";

export const s3Client = new S3Client({
  endpoint,
  region,
  credentials: {
    accessKeyId,
    secretAccessKey,
  },
  forcePathStyle: true, // Required for MinIO & local S3-compatible storage
});

export async function uploadToStorage(params: {
  key: string;
  buffer: Buffer;
  mimeType: string;
}): Promise<{ url: string; key: string }> {
  const command = new PutObjectCommand({
    Bucket: S3_BUCKET,
    Key: params.key,
    Body: params.buffer,
    ContentType: params.mimeType,
  });

  await s3Client.send(command);

  // If using public URL format:
  const publicBaseUrl = process.env.S3_PUBLIC_URL || `${endpoint}/${S3_BUCKET}`;
  const url = `${publicBaseUrl}/${params.key}`;

  return { url, key: params.key };
}

export async function deleteFromStorage(key: string): Promise<void> {
  const command = new DeleteObjectCommand({
    Bucket: S3_BUCKET,
    Key: key,
  });

  await s3Client.send(command);
}

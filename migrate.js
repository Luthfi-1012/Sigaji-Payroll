import fs from 'fs';
import path from 'path';

const sourceDir = 'c:\\Users\\Luthfi\\sigaji\\stitch_sigaji_payroll_system';
const destDir = 'c:\\Users\\Luthfi\\sigaji\\resources\\views';

const pages = [
    { src: 'sigaji_admin_tambah_karyawan_baru_modal', dest: 'admin/tambah-karyawan.blade.php' },
];

for (const page of pages) {
    const htmlPath = path.join(sourceDir, page.src, 'code.html');
    const bladePath = path.join(destDir, page.dest);

    if (fs.existsSync(htmlPath)) {
        const html = fs.readFileSync(htmlPath, 'utf8');
        const bodyMatch = html.match(/<body[^>]*>([\s\S]*)<\/body>/i);
        const styleMatch = html.match(/<style>([\s\S]*?)<\/style>/i);
        
        let content = '';
        if (bodyMatch) {
            content = bodyMatch[1].replace(/<script[^>]*>([\s\S]*?)<\/script>/gi, (match, scriptContent) => {
                // If it's the tailwind script, ignore it
                if (match.includes('id="tailwind-config"')) return '';
                // Else put it in scripts section
                return `@section('scripts')\n<script>\n${scriptContent}\n</script>\n@endsection`;
            });
        }

        let bladeContent = `@extends('layouts.app')\n\n@section('title', '${page.src}')\n\n`;
        if (styleMatch) {
            let style = styleMatch[1].replace(/body\s*\{[^}]+\}/i, '');
            bladeContent += `@section('styles')\n<style>\n${style}\n</style>\n@endsection\n\n`;
        }
        
        let cleanContent = bodyMatch ? bodyMatch[1].replace(/<script[\s\S]*?<\/script>/gi, '') : '';
        
        let scripts = [];
        const scriptRegex = /<script>([\s\S]*?)<\/script>/gi;
        let match;
        while ((match = scriptRegex.exec(bodyMatch ? bodyMatch[1] : '')) !== null) {
            if (!match[0].includes('tailwind-config')) {
                scripts.push(match[1]);
            }
        }

        bladeContent += `@section('content')\n${cleanContent}\n@endsection\n\n`;
        if (scripts.length > 0) {
            bladeContent += `@section('scripts')\n<script>\n${scripts.join('\n')}\n</script>\n@endsection\n`;
        }

        fs.mkdirSync(path.dirname(bladePath), { recursive: true });
        fs.writeFileSync(bladePath, bladeContent, 'utf8');
        console.log(`Migrated ${page.src} to ${page.dest}`);
    }
}

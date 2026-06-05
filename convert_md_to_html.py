import sys, re

def md_to_html(md_text):
    html = """<html><head><style>
        body { font-family: sans-serif; max-width: 800px; margin: 40px auto; padding: 20px; line-height: 1.6; }
        h1, h2, h3 { color: #2c3e50; }
        h1 { border-bottom: 2px solid #eee; padding-bottom: 10px; }
        img { max-width: 100%; height: auto; display: block; margin: 20px 0; border: 1px solid #ddd; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        table { border-collapse: collapse; width: 100%; margin: 20px 0; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background-color: #f8f9fa; font-weight: bold; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        ul { padding-left: 20px; }
        li { margin-bottom: 8px; }
        .checkbox-list { list-style: none; padding-left: 0; }
        p { margin-bottom: 16px; }
        b { font-weight: 600; }
    </style></head><body>"""
    
    lines = md_text.splitlines()
    in_table = False
    in_list = False
    
    for line in lines:
        line = line.strip()
        
        # Handle table closing
        if in_table and not line.startswith('|'):
            html += "</table>\n"
            in_table = False
            
        # Handle list closing (simple logic: if not starting with -, close list)
        if in_list and not line.startswith('-'):
            html += "</ul>\n"
            in_list = False

        if not line:
            continue
            
        # Basic formatting
        line = re.sub(r'\*\*(.*?)\*\*', r'<b>\1</b>', line)
        # Images: ![alt](src) -> <img ...>
        line = re.sub(r'!\[(.*?)\]\((.*?)\)', r'<img src="\2" alt="\1">', line)
        # Links: [text](href) -> <a ...> (Use negative lookbehind (?<!!) to ensure we don't match images again if regex overlaps, though the ! match above handles it mostly. 
        # But simpler: we already consumed ![...] with the line above? No, re.sub returns new string.
        # So we just need to make sure [text](href) doesn't catch what used to be ![text](href) if it wasn't replaced?
        # Actually since we replaced ![...](...) with <img...>, the next regex won't find ![...]. 
        # But we must be careful not to break the <img ...> tag we just made? <img src="..."> has no []. Safe.
        line = re.sub(r'(?<!!)\[(.*?)\]\((.*?)\)', r'<a href="\2">\1</a>', line)
            
        # Headers
        if line.startswith('# '):
            html += f"<h1>{line[2:]}</h1>\n"
        elif line.startswith('## '):
            html += f"<h2>{line[3:]}</h2>\n"
        elif line.startswith('### '):
            html += f"<h3>{line[4:]}</h3>\n"
            
        # Images (Markdown default: ![alt](src))
        elif line.startswith('![') and '](' in line:
            alt = line[line.find('[')+1:line.find(']')]
            src = line[line.find('](')+2:-1]
            if src.startswith('file://'):
                src = src.replace('file://', '')
            html += f'<img src="{src}" alt="{alt}">\n<p style="text-align:center; font-style:italic; font-size:0.9em; color:#666;">{alt}</p>\n'
            
        # Tables
        elif line.startswith('|'):
            if not in_table:
                html += "<table>\n"
                in_table = True
            # Simple row parsing
            cells = [c.strip() for c in line.strip('|').split('|')]
            # Check if header separator row
            if '---' in cells[0]:
                continue
            
            tag = "td"
            # Assume first row of table block is header if we just started, or specific logic? 
            # Markdown tables usually imply first row is header. Let's overly simplify: if row contains bold, treat as header? No.
            # Let's just use td for simplicity or th if it looks like header.
            # Actually, standard markdown tables require the --- row to define headers. 
            # My parser is too simple to look ahead. Let's just use td.
            row = "<tr>" + "".join([f"<{tag}>{c}</{tag}>" for c in cells]) + "</tr>"
            html += row + "\n"
            
        # Lists and Checkboxes
        elif line.startswith('- [ ]'):
            if not in_list: html += '<ul class="checkbox-list">\n'; in_list = True
            html += f'<li><input type="checkbox" disabled> {line[6:]}</li>\n'
        elif line.startswith('- [x]'):
            if not in_list: html += '<ul class="checkbox-list">\n'; in_list = True
            html += f'<li><input type="checkbox" checked disabled> {line[6:]}</li>\n'
        elif line.startswith('- '):
            if not in_list: html += '<ul>\n'; in_list = True
            html += f"<li>{line[2:]}</li>\n"
            
        else:
            html += f"<p>{line}</p>\n"
            
    if in_table: html += "</table>\n"
    if in_list: html += "</ul>\n"
        
    html += "</body></html>"
    return html

if __name__ == "__main__":
    try:
        with open('MODERNIZATION_PROPOSAL.md', 'r') as f:
            md = f.read()
        html = md_to_html(md)
        with open('MODERNIZATION_PROPOSAL.html', 'w') as f:
            f.write(html)
        print("Successfully converted MD to HTML")
    except Exception as e:
        print(f"Error: {e}")

import pandas,os,re,json
from datetime import datetime


class GeneratePathScript:

    def __init__(self,filepath) -> None:
        self.escenas = pandas.read_csv(f'{filepath}/escenas.csv')
        self.hotspot_info = pandas.read_csv(f'{filepath}/hotspotinfo.csv')
        self.hotspot_escenas = pandas.read_csv(f'{filepath}/hotspotescenas.csv')
        self.documento = ''
        self.final_documento = ''


    def crea_fichero_base(self):
        BASE = '''<!DOCTYPE html>
    <html lang="en">
    <head>
    <meta name="generator" content="Hugo 0.48" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pannellum</title>
    <!--<script src="/cdn-cgi/apps/head/TEAHVq5cVsVoM9egFOAS6CBdXPk.js"></script>-->
    <link rel="stylesheet" href="https://pannellum.org/css/bootstrap.min.css">
    <script type="text/javascript" src="js/bootstrap-native.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600%7CSource+Code+Pro:400,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="css/pygments.css">
    <link rel="stylesheet" href="css/pannellum.css" />
    <script type="text/javascript" src="js/pannellum.js"></script>
    <link rel="stylesheet" href="css/style.css">
    </head>
    <body>

        <div id="panorama" style="width:100%;height:100%;"></div>
        <script>
        pannellum.viewer('panorama', '''
        self.documento = BASE


    def generate_json(self):
        primera_escena = self.escenas.iloc[0]
        self.json_dict = {
            "default": {
                "firstScene": primera_escena['idEscena'],
                "author": "Tecnibus24",
                "sceneFadeDuration": 1000,
                "autoLoad": True
            },
            "scenes":{}
        }
        
        for i,escena in self.escenas.iterrows():
            self.json_dict["scenes"][escena['idEscena']] = {
                "title": escena['title'],
                "hfov": 150,
                "pitch": 0,
                "yaw": 0,
                "compass": True,
                "northOffset": 70,
                "type": "multires",
                "multiRes": {
                    "basePath": escena['basePath'],
                    "path": "/%l/%s%y_%x",
                    "fallbackPath": "/fallback/%s",
                    "extension": "jpg",
                    "tileResolution": 512,
                    "maxLevel": 3,
                    "cubeResolution": 1928
                },
                "hotSpots":[]
            }

        for i,hotspotinfo in self.hotspot_info.iterrows():
            self.json_dict["scenes"][hotspotinfo['idEscena']]["hotSpots"].append({
                "pitch": hotspotinfo['pitch'] if not pandas.isna(hotspotinfo['pitch']) else 0,
                "yaw": hotspotinfo['yaw'] if not pandas.isna(hotspotinfo['yaw']) else 0,
                "type": "info",
                "text": hotspotinfo['text'] if not pandas.isna(hotspotinfo['text']) else "",
                "URL": hotspotinfo['URL'] if not pandas.isna(hotspotinfo['URL']) else ""
            })

        for i,hotspotescena in self.hotspot_escenas.iterrows():
            self.json_dict["scenes"][hotspotescena['idEscena']]["hotSpots"].append({
                "pitch": hotspotescena['pitch'] if not pandas.isna(hotspotescena['pitch']) else 0,
                "yaw": hotspotescena['yaw'] if not pandas.isna(hotspotescena['yaw']) else 0,
                "type": "scene",
                "text": hotspotescena['text'] if not pandas.isna(hotspotescena['text']) else "",
                "sceneId": hotspotescena['sceneId'] if not pandas.isna(hotspotescena['sceneId']) else "",
                "targetYaw": hotspotescena['targetYaw'] if not pandas.isna(hotspotescena['targetYaw']) else 0,
                "targetPitch": hotspotescena['targetPitch'] if not pandas.isna(hotspotescena['targetPitch']) else 0,
            })

    def join_document(self):
        CIERRE = ''');
</script>

</body>
</html>'''
        self.final_documento = self.documento + json.dumps(self.json_dict,ensure_ascii=False,indent=4).encode('utf8').decode('utf8') + CIERRE

    def main(self):
        self.crea_fichero_base()
        self.generate_json()
        self.join_document()

        if not os.path.exists('out'):
            os.mkdir('out')
        current_date = datetime.now().strftime('%Y%m%d_%H%M%S')
        with open(f'out/{current_date}.html','w',encoding='utf8') as fbase:
            fbase.write(self.final_documento)
    

if __name__ == '__main__':
    GeneratePathScript('data').main()
    
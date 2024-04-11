#API para obtener informacón de los elementos: películas, series y libros

from flask import Flask, request, jsonify
import requests
import imdb
import pprint
import json
import xmltodict
from imdb import IMDbError
import itertools
from flask_cors import CORS

app =  Flask(__name__)
CORS(app)  # Habilitar CORS para todos los endpoints
# home route that returns below text when root url is accessed

def search_element(id):
    cine = imdb.IMDb()
    items = cine.get_movie(id)
    #items = cine.search_movie(name)
    
    return items
        
    #items_json = []
    
    # try:
       
    #     item_info = {
    #         'id' : item['id'],
    #         'title': item['title'],
    #         'year': item['year'],
    #         'kind': item['kind'],
    #         'cover_url' : item['cover_url']
    #         # Agrega otros atributos según sea necesario
    #     }
    #     items_json.append(item_info)  
    #     print(item['title'])
@app.route("/", methods=['POST'])    
def show_element():
    try:
        ids_imdb = request.form.getlist('ids_imdb')
        
        id='332280'
        #elements = search_element(id)
        results = []
        for ids in ids_imdb:
            results.append(ids)
        
        # Recorrer los elementos y obtener su información
        
        # for element in elements:
        #     # print("ID:", element.getID())  # Obtener el ID del elemento
        #     results.append({
                
        #         'Título': element['title'],
        #         'año': element['year'],
        #         'Tipo': element['kind']
        #     })
        
        # results = {
        #     'id' : id,
        #     'titulo' : elements.get('title'),
        #     'año' : elements.get('year'),
        #     'tipo' : elements.get('kind')
        # }
        return jsonify({"message": results})    
    except requests.RequestException as e:
    # Manejar cualquier error de solicitud
        return jsonify({
            "success": False,
            "message": f"Error al realizar la solicitud a la API de OpenWeatherMap: {str(e)}"
        })    
        
    
    #     print()  # Imprimir una línea en blanco entre cada elemento
            
 
if __name__ == '__main__':  
   app.run(debug=True)
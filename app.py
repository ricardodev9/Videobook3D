#API para obtener informacón de los elementos: películas, series y libros
import flask
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

# def search_element(id):
#     cine = imdb.IMDb()
#     # items = cine.get_movie(id)
#     res = []
#     for i in id:
#         items = cine.get_movie(i)
#         res.append({i : items})
#     return res

# @app.route("/", methods=['GET','POST'])    
# def show_element():
#     try:
#         id_imdb = request.form.getlist('ids_imdb[]')
#         results = []
#         movies = search_element(id_imdb)
#         for movie in movies:  
#             # Iteramos sobre cada elemento en la lista de diccionarios
#             for id, info in movie.items():
#                 results.append({
#                     'ID': id,  # Utilizamos el ID del diccionario como ID del resultado
#                     'Título': info.get('title'),
#                     'Año': info.get('year'),
#                     'Tipo': info.get('kind')
#                 })
            
#         return jsonify({"type":"ok","msg":results})
#     except requests.RequestException as e:
#         # Manejar cualquier error de solicitud
#         return jsonify({
#             "success": False,
#             "message": f"Error al realizar la solicitud a la API de OpenWeatherMap: {str(e)}"
#         })           
def search_element(id):
    cine = imdb.IMDb()
    # items = cine.get_movie(id)
   
    items = cine.get_movie(id)
        
    return items

@app.route("/<id_imdb>", methods=['GET','POST'])    
def show_element(id_imdb):
    #ids_imdb = request.form.getlist('ids_imdb[]')
    
    #for id in ids_imdb:
    cine = search_element(id_imdb)#id='332280')
    result = []
    # for per in cine['cast']:
    #     #print(per.personID)
    #     result.append({
    #         per.personID : per['name']
    #     })
    return jsonify({"type" : "ok" , "msg" : id_imdb})

if __name__ == '__main__':  
   app.run(debug=True)
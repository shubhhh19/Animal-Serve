/* ======================================================== */
/* FILENAME : animals.cpp                                   */
/* PROJECT : A-02-Animal Serve in CGI and PHP               */
/* BY : Shubh Soni (8887735) & Jatinjeet Thakur (8772615)   */
/* DATE : Oct 14, 2023                                      */
/* DESCRIPTION : This program displays information about    */
/*       selected animals from a zoo based on user input.   */
/* ======================================================== */
#include <stdio.h>
#include <stdlib.h>
#include <string.h>

int main(void) {
          char* inputData;
          char* contentLength = getenv("CONTENT_LENGTH");

          printf("Content-Type: text/html\n\n");
          printf("<!DOCTYPE html>\n");
          printf("<html>\n");
          printf("<head>\n");
          printf("<title>Zoo Results</title>\n");
          printf("</head>\n");
          printf("<body>\n");

          if (contentLength != NULL) {
                    int len = atoi(contentLength);
                    inputData = (char*)malloc(static_cast<size_t>(len) + 1);
                    fgets(inputData, len + 1, stdin);

                    char* name = NULL;
                    char* animal = NULL;

                    // Parse the form data
                    char* pair = strtok(inputData, "&");
                    while (pair != NULL) {
                              char* key = strtok(pair, "=");
                              char* value = strtok(NULL, "=");

                              if (key != NULL && value != NULL) {
                                        if (strcmp(key, "name") == 0) {
                                                  name = value;
                                        }
                                        else if (strcmp(key, "animal") == 0) {
                                                  animal = value;
                                        }
                              }
                              pair = strtok(NULL, "&");
                    }

                    if (name == NULL || animal == NULL) {
                              printf("<p>Form data is incomplete or missing.</p>\n");
                    }
                    else {
                              printf("<h2>Hello, %s!</h2>\n", name);
                              printf("<p>You have selected %s.</p>\n", animal);

                              // Load the animal description file
                              char descriptionFile[100];
                              sprintf(descriptionFile, "theZoo/%s.txt", animal);

                              FILE* file = fopen(descriptionFile, "r");
                              if (file) {
                                        char line[256];
                                        printf("<p>");
                                        while (fgets(line, sizeof(line), file)) {
                                                  printf("%s<br>", line);
                                        }
                                        printf("</p>");
                                        fclose(file);
                              }
                              else {
                                        printf("<p>The description for the %s is not found</p>\n", animal);
                              }

                              // Load the animal image
                              char imagePath[100];
                              sprintf(imagePath, "theZoo/%s.jpg", animal);

                              FILE* imgFile = fopen(imagePath, "rb");
                              if (imgFile) {
                                        fseek(imgFile, 0, SEEK_END);
                                        long imgSize = ftell(imgFile);
                                        fseek(imgFile, 0, SEEK_SET);

                                        char* imgData = (char*)malloc(imgSize);
                                        fread(imgData, 1, imgSize, imgFile);

                                        fclose(imgFile);

                                        printf("<img src=\"data:image/jpeg;base64,");
                                        for (int i = 0; i < imgSize; i++) {
                                                  printf("%02x", (unsigned char)imgData[i]);
                                        }
                                        printf("\" alt=\"%s\" width='400' height='400'>\n", animal);

                                        free(imgData);
                              }
                              else {
                                        printf("<p>Image for %s not found</p>\n", animal);
                              }
                    }
                    free(inputData);
          }
          else {
                    printf("<p>Content-Length header is missing.</p>\n");
          }

          printf("</body>\n");
          printf("</html>\n");
          return 0;
}

<?php
/*
 * --------------------------------------------------------------------------------
 * <copyright company="Aspose" file="RenderParagraphOnlineRequest.php">
 *   Copyright (c) 2023 Aspose.Words for Cloud
 * </copyright>
 * <summary>
 *   Permission is hereby granted, free of charge, to any person obtaining a copy
 *  of this software and associated documentation files (the "Software"), to deal
 *  in the Software without restriction, including without limitation the rights
 *  to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 *  copies of the Software, and to permit persons to whom the Software is
 *  furnished to do so, subject to the following conditions:
 * 
 *  The above copyright notice and this permission notice shall be included in all
 *  copies or substantial portions of the Software.
 * 
 *  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 *  IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 *  FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 *  AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 *  LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 *  OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 *  SOFTWARE.
 * </summary>
 * --------------------------------------------------------------------------------
 */

namespace Aspose\Words\Model\Requests;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\RequestOptions;
use Aspose\Words\ObjectSerializer;
use Aspose\Words\HeaderSelector;
use Aspose\Words\Model\Response\RenderParagraphOnlineResponse;
use Aspose\Words\Encryptor;

/*
 * Request model for renderParagraphOnline operation.
 */
class RenderParagraphOnlineRequest extends BaseApiRequest
{
    /*
     * The document.
     */
    public $document;

    /*
     * The destination format.
     */
    public $format;

    /*
     * Object index.
     */
    public $index;

    /*
     * The path to the node in the document tree.
     */
    public $node_path;

    /*
     * Encoding that will be used to load an HTML (or TXT) document if the encoding is not specified in HTML.
     */
    public $load_encoding;

    /*
     * Password of protected Word document. Use the parameter to pass a password via SDK. SDK encrypts it automatically. We don't recommend to use the parameter to pass a plain password for direct call of API.
     */
    public $password;

    /*
     * Password of protected Word document. Use the parameter to pass an encrypted password for direct calls of API. See SDK code for encyption details.
     */
    public $encrypted_password;

    /*
     * Result path of the document after the operation. If this parameter is omitted then result of the operation will be saved as the source document.
     */
    public $dest_file_name;

    /*
     * Folder in filestorage with custom fonts.
     */
    public $fonts_location;

    /*
     * Initializes a new instance of the RenderParagraphOnlineRequest class.
     *
     * @param \SplFileObject $document The document.
     * @param string $format The destination format.
     * @param int $index Object index.
     * @param string $node_path The path to the node in the document tree.
     * @param string $load_encoding Encoding that will be used to load an HTML (or TXT) document if the encoding is not specified in HTML.
     * @param string $password Password of protected Word document. Use the parameter to pass a password via SDK. SDK encrypts it automatically. We don't recommend to use the parameter to pass a plain password for direct call of API.
     * @param string $encrypted_password Password of protected Word document. Use the parameter to pass an encrypted password for direct calls of API. See SDK code for encyption details.
     * @param string $dest_file_name Result path of the document after the operation. If this parameter is omitted then result of the operation will be saved as the source document.
     * @param string $fonts_location Folder in filestorage with custom fonts.
     */
    public function __construct($document, $format, $index, $node_path = null, $load_encoding = null, $password = null, $encrypted_password = null, $dest_file_name = null, $fonts_location = null)
    {
        $this->document = $document;
        $this->format = $format;
        $this->index = $index;
        $this->node_path = $node_path;
        $this->load_encoding = $load_encoding;
        $this->password = $password;
        $this->encrypted_password = $encrypted_password;
        $this->dest_file_name = $dest_file_name;
        $this->fonts_location = $fonts_location;
    }

    /*
     * The document.
     */
    public function get_document()
    {
        return $this->document;
    }

    /*
     * The document.
     */
    public function set_document($value)
    {
        $this->document = $value;
        return $this;
    }

    /*
     * The destination format.
     */
    public function get_format()
    {
        return $this->format;
    }

    /*
     * The destination format.
     */
    public function set_format($value)
    {
        $this->format = $value;
        return $this;
    }

    /*
     * Object index.
     */
    public function get_index()
    {
        return $this->index;
    }

    /*
     * Object index.
     */
    public function set_index($value)
    {
        $this->index = $value;
        return $this;
    }

    /*
     * The path to the node in the document tree.
     */
    public function get_node_path()
    {
        return $this->node_path;
    }

    /*
     * The path to the node in the document tree.
     */
    public function set_node_path($value)
    {
        $this->node_path = $value;
        return $this;
    }

    /*
     * Encoding that will be used to load an HTML (or TXT) document if the encoding is not specified in HTML.
     */
    public function get_load_encoding()
    {
        return $this->load_encoding;
    }

    /*
     * Encoding that will be used to load an HTML (or TXT) document if the encoding is not specified in HTML.
     */
    public function set_load_encoding($value)
    {
        $this->load_encoding = $value;
        return $this;
    }

    /*
     * Password of protected Word document. Use the parameter to pass a password via SDK. SDK encrypts it automatically. We don't recommend to use the parameter to pass a plain password for direct call of API.
     */
    public function get_password()
    {
        return $this->password;
    }

    /*
     * Password of protected Word document. Use the parameter to pass a password via SDK. SDK encrypts it automatically. We don't recommend to use the parameter to pass a plain password for direct call of API.
     */
    public function set_password($value)
    {
        $this->password = $value;
        return $this;
    }

    /*
     * Password of protected Word document. Use the parameter to pass an encrypted password for direct calls of API. See SDK code for encyption details.
     */
    public function get_encrypted_password()
    {
        return $this->encrypted_password;
    }

    /*
     * Password of protected Word document. Use the parameter to pass an encrypted password for direct calls of API. See SDK code for encyption details.
     */
    public function set_encrypted_password($value)
    {
        $this->encrypted_password = $value;
        return $this;
    }

    /*
     * Result path of the document after the operation. If this parameter is omitted then result of the operation will be saved as the source document.
     */
    public function get_dest_file_name()
    {
        return $this->dest_file_name;
    }

    /*
     * Result path of the document after the operation. If this parameter is omitted then result of the operation will be saved as the source document.
     */
    public function set_dest_file_name($value)
    {
        $this->dest_file_name = $value;
        return $this;
    }

    /*
     * Folder in filestorage with custom fonts.
     */
    public function get_fonts_location()
    {
        return $this->fonts_location;
    }

    /*
     * Folder in filestorage with custom fonts.
     */
    public function set_fonts_location($value)
    {
        $this->fonts_location = $value;
        return $this;
    }

    /*
     * Create request data for operation 'renderParagraphOnline'
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function createRequestData($config)
    {
        if ($this->document === null) {
            throw new \InvalidArgumentException('Missing the required parameter $document when calling renderParagraphOnline');
        }
        if ($this->format === null) {
            throw new \InvalidArgumentException('Missing the required parameter $format when calling renderParagraphOnline');
        }
        if ($this->index === null) {
            throw new \InvalidArgumentException('Missing the required parameter $index when calling renderParagraphOnline');
        }

        $resourcePath = '/words/online/get/{nodePath}/paragraphs/{index}/render';
        $formParams = [];
        $filesContent = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = "";
        $filename = null;
        // path params
        if ($this->index !== null) {
            $localName = lcfirst('Index');
            $resourcePath = str_replace('{' . $localName . '}', ObjectSerializer::toPathValue($this->index), $resourcePath);
        }
        else {
            $localName = lcfirst('Index');
            $resourcePath = str_replace('{' . $localName . '}', '', $resourcePath);
        }
        // path params
        if ($this->node_path !== null) {
            $localName = lcfirst('NodePath');
            $resourcePath = str_replace('{' . $localName . '}', ObjectSerializer::toPathValue($this->node_path), $resourcePath);
        }
        else {
            $localName = lcfirst('NodePath');
            $resourcePath = str_replace('{' . $localName . '}', '', $resourcePath);
        }

        // remove empty path parameters
        $resourcePath = str_replace("//", "/", $resourcePath);
        // query params
        if ($this->format !== null) {
            $localName = lcfirst('Format');
            $localValue = is_bool($this->format) ? ($this->format ? 'true' : 'false') : $this->format;
            if (strpos($resourcePath, '{' . $localName . '}') !== false) {
                $resourcePath = str_replace('{' . $localName . '}', ObjectSerializer::toQueryValue($localValue), $resourcePath);
            } else {
                $queryParams[$localName] = ObjectSerializer::toQueryValue($localValue);
            }
        }
        // query params
        if ($this->load_encoding !== null) {
            $localName = lcfirst('LoadEncoding');
            $localValue = is_bool($this->load_encoding) ? ($this->load_encoding ? 'true' : 'false') : $this->load_encoding;
            if (strpos($resourcePath, '{' . $localName . '}') !== false) {
                $resourcePath = str_replace('{' . $localName . '}', ObjectSerializer::toQueryValue($localValue), $resourcePath);
            } else {
                $queryParams[$localName] = ObjectSerializer::toQueryValue($localValue);
            }
        }
        // query params
        if ($this->password !== null) {
            $localName = lcfirst('Password');
            $localValue = is_bool($this->password) ? ($this->password ? 'true' : 'false') : $this->password;
            if (strpos($resourcePath, '{' . $localName . '}') !== false) {
                $resourcePath = str_replace('{' . $localName . '}', ObjectSerializer::toQueryValue($localValue), $resourcePath);
            } else {
                $queryParams[$localName] = ObjectSerializer::toQueryValue($localValue);
            }
        }
        // query params
        if ($this->encrypted_password !== null) {
            $localName = lcfirst('EncryptedPassword');
            $localValue = is_bool($this->encrypted_password) ? ($this->encrypted_password ? 'true' : 'false') : $this->encrypted_password;
            if (strpos($resourcePath, '{' . $localName . '}') !== false) {
                $resourcePath = str_replace('{' . $localName . '}', ObjectSerializer::toQueryValue($localValue), $resourcePath);
            } else {
                $queryParams[$localName] = ObjectSerializer::toQueryValue($localValue);
            }
        }
        // query params
        if ($this->dest_file_name !== null) {
            $localName = lcfirst('DestFileName');
            $localValue = is_bool($this->dest_file_name) ? ($this->dest_file_name ? 'true' : 'false') : $this->dest_file_name;
            if (strpos($resourcePath, '{' . $localName . '}') !== false) {
                $resourcePath = str_replace('{' . $localName . '}', ObjectSerializer::toQueryValue($localValue), $resourcePath);
            } else {
                $queryParams[$localName] = ObjectSerializer::toQueryValue($localValue);
            }
        }
        // query params
        if ($this->fonts_location !== null) {
            $localName = lcfirst('FontsLocation');
            $localValue = is_bool($this->fonts_location) ? ($this->fonts_location ? 'true' : 'false') : $this->fonts_location;
            if (strpos($resourcePath, '{' . $localName . '}') !== false) {
                $resourcePath = str_replace('{' . $localName . '}', ObjectSerializer::toQueryValue($localValue), $resourcePath);
            } else {
                $queryParams[$localName] = ObjectSerializer::toQueryValue($localValue);
            }
        }
        if (property_exists($this, 'password') && $this->password != null)
        {
            unset($queryParams['password']);
            $queryParams['encryptedPassword'] = $config->getEncryptor()->encrypt($this->password);
        }

        $resourcePath = ObjectSerializer::parseURL($config, $resourcePath, $queryParams);
        // form params
        if ($this->document !== null) {
            $filename = ObjectSerializer::toFormValue($this->document);
            $handle = fopen($filename, "rb");
            $fsize = filesize($filename);
            $contents = fread($handle, $fsize);
            array_push($formParams, ['name' => 'Document', 'content' => $contents, 'mime' => 'application/octet-stream']);
        }

        foreach ($filesContent as $fileContent)
        {
            $filesContent_filename = ObjectSerializer::toFormValue($fileContent->getContent());
            $filesContent_handle = fopen($filesContent_filename, "rb");
            $filesContent_fsize = filesize($filesContent_filename);
            $filesContent_contents = fread($filesContent_handle, $filesContent_fsize);
            array_push($formParams, ['name' => $fileContent->getReference(), 'content' => $filesContent_contents, 'mime' => 'application/octet-stream']);
        }

        // body params
        $_tempBody = null;
        if (count($formParams) == 1) {
            $_tempBody = array_shift($formParams);
        }

        $headerParams = [];
        // for model (json/xml)
        if (isset($_tempBody)) {
            $headerParams['Content-Type'] = $_tempBody['mime'];
            if ($_tempBody['mime'] == 'application/json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($_tempBody['content']));
            } else {
                $httpBody = ObjectSerializer::sanitizeForSerialization($_tempBody['content']);
            }
        } elseif (count($formParams) > 1) {
            $multipartContents = [];
            foreach ($formParams as $formParam) {
                $multipartContents[] = [
                    'name' => $formParam['name'],
                    'contents' => $formParam['content'],
                    'headers' => ['Content-Type' => $formParam['mime']]
                ];
            }
            // for HTTP post (form)
            $httpBody = new MultipartStream($multipartContents);
            $headerParams['Content-Type'] = "multipart/form-data; boundary=" . $httpBody->getBoundary();
        }

        $result = array();
        $result['method'] = 'PUT';
        $result['url'] = $resourcePath;
        $result['headers'] = $headerParams;
        $result['body'] = $httpBody;
        return $result;
    }

    /*
     * Create request for operation 'renderParagraphOnline'
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function createRequest($config)
    {
        $reqdata = $this->createRequestData($config);
        $defaultHeaders = [];

        if ($config->getAccessToken() !== null) {
            $defaultHeaders['Authorization'] = 'Bearer ' . $config->getAccessToken();
        }

        if ($config->getUserAgent()) {
            $defaultHeaders['x-aspose-client'] = $config->getUserAgent();
        }

        $defaultHeaders['x-aspose-client-version'] = $config->getClientVersion();

        $reqdata['headers'] = array_merge($defaultHeaders, $reqdata['headers']);
        $req = new Request(
            $reqdata['method'],
            $reqdata['url'],
            $reqdata['headers'],
            $reqdata['body']
        );

        if ($config->getDebug()) {
            $this->_writeRequestLog($reqdata['method'], $reqdata['url'], $reqdata['headers'], $reqdata['body']);
        }

        return $req;
    }

    /*
     * Gets response type of this request.
     */
    public function getResponseType()
    {
        return '\SplFileObject';
    }

    public function deserializeResponse($response)
    {
        return ObjectSerializer::deserialize($response, '\SplFileObject', $response->getHeaders());
    }
}
